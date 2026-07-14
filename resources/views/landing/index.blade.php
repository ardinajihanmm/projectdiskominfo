@extends('layouts.landing')

@section('content')

{{-- Announcement --}}
<section id="announcement">
    <div class="container py-3">
        <h5>Pengumuman</h5>
        <p>
            Selamat datang di Portal Helpdesk Diskominfo Kabupaten Pemalang.
        </p>
    </div>
</section>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg bg-light border-bottom">
    <div class="container">

        <a class="navbar-brand" href="#">
            Helpdesk Diskominfo
        </a>

        <div class="ms-auto">
            <a href="{{ route('login') }}" class="btn btn-primary">
                Login
            </a>
        </div>

    </div>
</nav>

{{-- Hero --}}
<section id="hero" class="py-5">
    <div class="container">

        <h1>Helpdesk Diskominfo Kabupaten Pemalang</h1>

        <p>
            Portal pengajuan layanan teknologi informasi.
        </p>

    </div>
</section>

{{-- Services --}}
<section id="services" class="py-5">

    <div class="container">

        <h2 class="mb-4">Daftar Layanan</h2>

        <div class="row">

            @foreach($services as $service)

                <div class="col-md-4 mb-3">

                    <div class="card">

                        <div class="card-body">

                            <h5>{{ $service->nama }}</h5>

                            <p>{{ $service->bidang }}</p>

                            <button
                                class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#serviceModal{{ $service->id }}">

                                Lihat Detail

                            </button>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>

{{-- Alur --}}
<section id="flow" class="py-5">

    <div class="container">

        <h2>Alur Pengajuan</h2>

        <ol>
            <li>Login</li>
            <li>Pilih Layanan</li>
            <li>Isi Formulir</li>
            <li>Verifikasi Admin</li>
            <li>Proses Tim</li>
            <li>Selesai</li>
        </ol>

    </div>

</section>

{{-- FAQ --}}
<section id="faq" class="py-5">

    <div class="container">

        <h2>FAQ</h2>

        <div class="accordion" id="faqAccordion">

            <div class="accordion-item">

                <h2 class="accordion-header">

                    <button class="accordion-button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq1">

                        Bagaimana cara mengajukan layanan?

                    </button>

                </h2>

                <div id="faq1"
                     class="accordion-collapse collapse show">

                    <div class="accordion-body">

                        Login kemudian pilih layanan dan isi formulir.

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

{{-- Footer --}}
<footer class="bg-light py-4">

    <div class="container text-center">

        © {{ date('Y') }} Helpdesk Diskominfo Kabupaten Pemalang

    </div>

</footer>

{{-- Modal Detail Layanan --}}
@foreach($services as $service)

<div class="modal fade"
     id="serviceModal{{ $service->id }}"
     tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5>{{ $service->nama }}</h5>

                <button class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <p><strong>Bidang:</strong> {{ $service->bidang }}</p>

                <p><strong>Estimasi:</strong> {{ $service->estimasi }} Hari</p>

                <p>{{ $service->deskripsi }}</p>

            </div>

            <div class="modal-footer">

                <a href="{{ route('login') }}"
                   class="btn btn-primary">

                    Login untuk Mengajukan

                </a>

            </div>

        </div>

    </div>

</div>

@endforeach

@endsection