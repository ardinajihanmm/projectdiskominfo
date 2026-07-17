console.log("CHART JS LOADED");

document.addEventListener("DOMContentLoaded", () => {

    const dataEl = document.getElementById("chartData");
    if (!dataEl) return;

    /* =====================================
       DATA AWAL (tanpa filter, dari controller)
    ===================================== */

    const initialTodo = Number(dataEl.dataset.todo || 0);
    const initialProgress = Number(dataEl.dataset.progress || 0);
    const initialCompleted = Number(dataEl.dataset.completed || 0);
    const statsUrl = dataEl.dataset.statsurl;

    const COLORS = {
        todo: "#F59E0B",
        progress: "#2563EB",
        completed: "#16A34A"
    };

    /* =====================================
       ELEMENT
    ===================================== */

    const filterMonth = document.getElementById("filterMonth");
    const filterYear = document.getElementById("filterYear");
    const filterService = document.getElementById("filterService");

    const monthText = document.getElementById("monthSelectText");
    const yearText = document.getElementById("yearSelectText");
    const serviceText = document.getElementById("serviceSelectText");

    const canvas = document.getElementById("statusDonutChart");

    /* =====================================
       HELPER
    ===================================== */

    function setText(id, value) {
        const el = document.getElementById(id);
        if (el) el.textContent = value;
    }

    function setWidth(id, value) {
        const el = document.getElementById(id);
        if (el) el.style.width = value;
    }

    function calculatePercent(value, total) {
        if (total === 0) return 0;
        return (value / total) * 100;
    }

    // Sinkronkan teks yang tampil (span faux) dengan opsi <select> asli yang dipilih
    function syncSelectText(selectEl, textEl, fallbackLabel) {
        if (!selectEl || !textEl) return;
        const selected = selectEl.options[selectEl.selectedIndex];
        textEl.textContent = selected && selected.value !== "" ? selected.text : fallbackLabel;
    }

    /* =====================================
       STATE FILTER (AND - bulan + tahun + layanan)
    ===================================== */

    let currentTodo = initialTodo;
    let currentProgress = initialProgress;
    let currentCompleted = initialCompleted;

    const filters = {
        month: "",
        year: "",
        service: ""
    };

    /* =====================================
       UPDATE UI (badge, donut center, legend, mini card)
    ===================================== */

    function updateUI(todoValue, progressValue, completedValue) {

        const total = todoValue + progressValue + completedValue;

        const pctTodo = calculatePercent(todoValue, total);
        const pctProgress = calculatePercent(progressValue, total);
        const pctCompleted = calculatePercent(completedValue, total);

        setText("badgeTotal", total);
        setText("donutTotal", total);

        setText("legendTodo", todoValue);
        setText("legendProgress", progressValue);
        setText("legendCompleted", completedValue);

        setText("pctTodo", pctTodo.toFixed(1) + "%");
        setText("pctProgress", pctProgress.toFixed(1) + "%");
        setText("pctCompleted", pctCompleted.toFixed(1) + "%");

        setText("miniPctTodo", pctTodo.toFixed(1) + "%");
        setText("miniPctProgress", pctProgress.toFixed(1) + "%");
        setText("miniPctCompleted", pctCompleted.toFixed(1) + "%");
        setText("miniPctTotal", "100%");

        setWidth("barTodo", pctTodo + "%");
        setWidth("barProgress", pctProgress + "%");
        setWidth("barCompleted", pctCompleted + "%");

        // angka besar di 4 mini card (To Do / In Progress / Completed / Total)
        setText("miniNumberTodo", todoValue.toLocaleString("id-ID"));
        setText("miniNumberProgress", progressValue.toLocaleString("id-ID"));
        setText("miniNumberCompleted", completedValue.toLocaleString("id-ID"));
        setText("miniNumberTotal", total.toLocaleString("id-ID"));
    }

    updateUI(currentTodo, currentProgress, currentCompleted);

    /* =====================================
       CHART
    ===================================== */

    let donutChart = null;

    if (canvas) {
        donutChart = new Chart(canvas, {
            type: "doughnut",
            data: {
                labels: ["To Do", "In Progress", "Completed"],
                datasets: [{
                    data: [currentTodo, currentProgress, currentCompleted],
                    backgroundColor: [COLORS.todo, COLORS.progress, COLORS.completed],
                    borderColor: "#ffffff",
                    borderWidth: 5,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: "70%",
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const p = total > 0 ? ((context.raw / total) * 100).toFixed(1) : 0;
                                return `${context.label}: ${context.raw} (${p}%)`;
                            }
                        }
                    }
                }
            },
            plugins: []
        });
    }

    /* =====================================
       UPDATE DONUT + SELURUH UI DARI SATU SUMBER DATA
    ===================================== */

    function updateDonut(todoValue, progressValue, completedValue) {

        currentTodo = Number(todoValue) || 0;
        currentProgress = Number(progressValue) || 0;
        currentCompleted = Number(completedValue) || 0;

        updateUI(currentTodo, currentProgress, currentCompleted);

        if (donutChart) {
            donutChart.data.datasets[0].data = [currentTodo, currentProgress, currentCompleted];
            donutChart.update();
        }
    }

    /* =====================================
       AMBIL DATA DARI SERVER SESUAI KOMBINASI FILTER (AND)
       Bulan + Tahun + Layanan dikirim bersamaan ke backend,
       backend yang menentukan hasil gabungan (bukan JS menimpa
       array lama), jadi tidak ada filter yang saling override.
    ===================================== */

    let isFetching = false;

    function fetchTicketStats() {

        if (!statsUrl) return;

        const params = new URLSearchParams();
        if (filters.month) params.append("month", filters.month);
        if (filters.year) params.append("year", filters.year);
        if (filters.service) params.append("service", filters.service);

        isFetching = true;

        fetch(`${statsUrl}?${params.toString()}`, {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
            .then(res => {
                if (!res.ok) throw new Error("Gagal mengambil data statistik");
                return res.json();
            })
            .then(data => {
                updateDonut(data.todo ?? 0, data.progress ?? 0, data.completed ?? 0);
            })
            .catch(err => {
                console.error(err);
            })
            .finally(() => {
                isFetching = false;
            });
    }

    /* =====================================
       EVENT FILTER (Bulan, Tahun, Layanan)
       Ketiganya menulis ke object `filters` yang sama,
       lalu fetchTicketStats() selalu mengirim ketiga nilai
       sekaligus -> hasilnya selalu kombinasi AND yang benar.
    ===================================== */

    if (filterMonth) {
        filterMonth.addEventListener("change", function () {
            filters.month = this.value;
            syncSelectText(this, monthText, "Semua Bulan");
            fetchTicketStats();
        });
    }

    if (filterYear) {
        filterYear.addEventListener("change", function () {
            filters.year = this.value;
            syncSelectText(this, yearText, "Semua Tahun");
            fetchTicketStats();
        });
    }

    if (filterService) {
        filterService.addEventListener("change", function () {
            filters.service = this.value;
            syncSelectText(this, serviceText, "Semua Layanan");
            fetchTicketStats();
        });
    }

    /* =====================================
       COUNTER CARD (angka di 4 card ringkasan atas)
    ===================================== */

    const counters = document.querySelectorAll(".counter");
    const COUNTER_DURATION = 2000; // dalam milidetik, naikkan angka ini kalau mau lebih lambat lagi

    counters.forEach(counter => {
        const target = Number(counter.dataset.target);
        const startTime = performance.now();

        function step(now) {
            const progress = Math.min((now - startTime) / COUNTER_DURATION, 1);
            const eased = 1 - Math.pow(1 - progress, 3); // ease-out, melambat di akhir
            const current = Math.floor(eased * target);

            counter.textContent = current.toLocaleString("id-ID");

            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                counter.textContent = target.toLocaleString("id-ID");
            }
        }

    requestAnimationFrame(step);
});

    /* =====================================
       CARD HOVER
    ===================================== */

    document.querySelectorAll(".modern-card").forEach(card => {
        card.addEventListener("mouseenter", () => {
            card.style.transition = ".3s";
        });
    });

});