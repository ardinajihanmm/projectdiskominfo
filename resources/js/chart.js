console.log("CHART JS LOADED");

document.addEventListener("DOMContentLoaded", () => {

    const dataEl = document.getElementById("chartData");
    if (!dataEl) return;

    /* =====================================
       DATA
    ===================================== */

    const todo = Number(dataEl.dataset.todo || 0);
    const progress = Number(dataEl.dataset.progress || 0);
    const completed = Number(dataEl.dataset.completed || 0);

    const monthlyLabels = JSON.parse(dataEl.dataset.monthlabels || "[]");
    const monthlyTotals = JSON.parse(dataEl.dataset.monthtotals || "[]");
    const monthlyTodo = JSON.parse(dataEl.dataset.monthtodo || "[]");
    const monthlyProgress = JSON.parse(dataEl.dataset.monthprogress || "[]");
    const monthlyCompleted = JSON.parse(dataEl.dataset.monthcompleted || "[]");

    const serviceLabels = JSON.parse(dataEl.dataset.servicelabels || "[]");
    const serviceTotals = JSON.parse(dataEl.dataset.servicetotals || "[]");
    const serviceTodo = JSON.parse(dataEl.dataset.servicetodo || "[]");
    const serviceProgress = JSON.parse(dataEl.dataset.serviceprogress || "[]");
    const serviceCompleted = JSON.parse(dataEl.dataset.servicecompleted || "[]");

    const COLORS = {
        todo: "#F59E0B",
        progress: "#2563EB",
        completed: "#16A34A"
    };

    /* =====================================
       ELEMENT
    ===================================== */

    const filterMonth = document.getElementById("filterMonth");
    const filterService = document.getElementById("filterService");

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

    /* =====================================
       INITIAL VALUE
    ===================================== */

    let currentTodo = todo;
    let currentProgress = progress;
    let currentCompleted = completed;

    let currentTotal =
        currentTodo +
        currentProgress +
        currentCompleted;

    /* =====================================
       UPDATE UI
    ===================================== */

    function updateUI(todoValue, progressValue, completedValue) {

        currentTotal =
            todoValue +
            progressValue +
            completedValue;

        const pctTodo =
            calculatePercent(todoValue, currentTotal);

        const pctProgress =
            calculatePercent(progressValue, currentTotal);

        const pctCompleted =
            calculatePercent(completedValue, currentTotal);

        setText("badgeTotal", currentTotal);
        setText("donutTotal", currentTotal);

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

    }

    updateUI(
        currentTodo,
        currentProgress,
        currentCompleted
    );

    /* =====================================
       DONUT LABEL PLUGIN
    ===================================== */

    const outerLabelPlugin = {

        id: "outerLabelPlugin",

        afterDraw(chart) {

            const ctx = chart.ctx;
            const meta = chart.getDatasetMeta(0);

            meta.data.forEach((arc, index) => {

                const value =
                    chart.data.datasets[0].data[index];

                if (value <= 0) return;

                const total =
                    chart.data.datasets[0].data.reduce(
                        (a, b) => a + b,
                        0
                    );

                const percent =
                    total === 0
                        ? 0
                        : ((value / total) * 100).toFixed(1);

                const angle =
                    (arc.startAngle + arc.endAngle) / 2;

                const x =
                    arc.x +
                    Math.cos(angle) *
                        (arc.outerRadius + 15);

                const y =
                    arc.y +
                    Math.sin(angle) *
                        (arc.outerRadius + 15);

                const x2 =
                    arc.x +
                    Math.cos(angle) *
                        (arc.outerRadius + 35);

                const y2 =
                    arc.y +
                    Math.sin(angle) *
                        (arc.outerRadius + 35);

                const right =
                    Math.cos(angle) > 0;

                ctx.save();

                ctx.beginPath();
                ctx.moveTo(x, y);
                ctx.lineTo(x2, y2);
                ctx.lineTo(
                    x2 + (right ? 18 : -18),
                    y2
                );

                ctx.strokeStyle = "#CBD5E1";
                ctx.lineWidth = 1;
                ctx.stroke();

                ctx.fillStyle =
                    chart.data.datasets[0]
                        .backgroundColor[index];

                ctx.font = "bold 13px Segoe UI";
                ctx.textAlign =
                    right ? "left" : "right";

                ctx.fillText(
                    percent + "%",
                    x2 + (right ? 22 : -22),
                    y2 + 4
                );

                ctx.restore();

            });

        }

    };
        /* =====================================
       CHART
    ===================================== */

    let donutChart = null;

    if (canvas) {

        donutChart = new Chart(canvas, {
            type: "doughnut",

            data: {
                labels: [
                    "To Do",
                    "In Progress",
                    "Completed"
                ],

                datasets: [{
                    data: [
                        currentTodo,
                        currentProgress,
                        currentCompleted
                    ],

                    backgroundColor: [
                        COLORS.todo,
                        COLORS.progress,
                        COLORS.completed
                    ],

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

                    legend: {
                        display: false
                    },

                    tooltip: {

                        callbacks: {

                            label(context) {

                                const total =
                                    context.dataset.data.reduce((a, b) => a + b, 0);

                                const p =
                                    total > 0
                                        ? ((context.raw / total) * 100).toFixed(1)
                                        : 0;

                                return `${context.label}: ${context.raw} (${p}%)`;

                            }

                        }

                    }

                }

            },

            plugins: [
                outerLabelPlugin
            ]

        });

    }

    /* =====================================
       UPDATE DONUT
    ===================================== */

    function updateDonut(todoValue, progressValue, completedValue) {

        currentTodo = Number(todoValue);
        currentProgress = Number(progressValue);
        currentCompleted = Number(completedValue);

        updateUI(
            currentTodo,
            currentProgress,
            currentCompleted
        );

        if (donutChart) {

            donutChart.data.datasets[0].data = [

                currentTodo,
                currentProgress,
                currentCompleted

            ];

            donutChart.update();

        }

    }

    /* =====================================
       FILTER BULAN
    ===================================== */

    if (filterMonth) {

        filterMonth.addEventListener("change", function () {

            if (this.value === "") {

                updateDonut(
                    todo,
                    progress,
                    completed
                );

                return;

            }

            const index = this.selectedIndex - 1;

            if (index < 0) return;

            updateDonut(

                monthlyTodo[index] ?? 0,
                monthlyProgress[index] ?? 0,
                monthlyCompleted[index] ?? 0

            );

        });

    }

    /* =====================================
       FILTER LAYANAN
    ===================================== */

    if (filterService) {

        filterService.addEventListener("change", function () {

            if (this.value === "") {

                updateDonut(
                    todo,
                    progress,
                    completed
                );

                return;

            }

            const index = this.selectedIndex - 1;

            if (index < 0) return;

            updateDonut(

                serviceTodo[index] ?? 0,
                serviceProgress[index] ?? 0,
                serviceCompleted[index] ?? 0

            );

        });

    }

    /* =====================================
       COUNTER CARD
    ===================================== */

    const counters = document.querySelectorAll(".counter");

    counters.forEach(counter => {

        const target =
            Number(counter.dataset.target);

        let current = 0;

        const step =
            Math.max(1, Math.ceil(target / 60));

        const timer = setInterval(() => {

            current += step;

            if (current >= target) {

                current = target;

                clearInterval(timer);

            }

            counter.textContent =
                current.toLocaleString("id-ID");

        }, 20);

    });

    /* =====================================
       CARD HOVER
    ===================================== */

    document
        .querySelectorAll(".modern-card")
        .forEach(card => {

            card.addEventListener("mouseenter", () => {

                card.style.transition = ".3s";

            });

        });

});