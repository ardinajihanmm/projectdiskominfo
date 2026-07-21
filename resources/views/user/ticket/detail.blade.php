@extends('layouts.user')
@section('title','Detail Tiket')
@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-ticket-detailed-fill text-primary"></i> Detail Pengajuan Tiket
            </h2>
            <small class="text-muted">Informasi lengkap mengenai tiket layanan Anda.</small>
        </div>
        <a href="{{ route('user.ticket.history') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-7">
                        <div class="mb-4">
                            <small class="text-muted">Kode Tiket</small>
                            <h2 class="fw-bold mb-0">{{ $ticket->kode_ticket }}</h2>
                        </div>
                        <div class="mb-4">
                            <small class="text-muted">Layanan</small>
                            <h4 class="fw-semibold">{{ $ticket->service->nama_layanan }}</h4>
                        </div>
                        <div class="mb-4">
                            <small class="text-muted">Judul Pengajuan</small>
                            <h4 class="fw-semibold">{{ $ticket->judul }}</h4>
                        </div>
                        <div class="mb-4">
                            <small class="text-muted">Pelapor</small>
                            <h5><i class="bi bi-person-circle text-primary"></i> {{ $ticket->user->name }}</h5>
                        </div>
                        <div class="mb-4">
                            <small class="text-muted">Email</small>
                            <h6><i class="bi bi-envelope-fill text-primary"></i> {{ $ticket->user->email }}</h6>
                        </div>
                        <div>
                            <small class="text-muted">Instansi</small>
                            <h6><i class="bi bi-building text-primary"></i> {{ $ticket->user->instansi }}</h6>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="border rounded-4 p-4 bg-light h-100">
                            <h5 class="fw-bold mb-4">Status Tiket</h5>

                            {{-- STATUS --}}
                            @if($ticket->status=="To Do")
                                <span class="badge bg-warning text-dark px-4 py-3 fs-6">
                                    <i class="bi bi-hourglass-split"></i> Menunggu Diproses
                                </span>
                            @elseif($ticket->status=="In Progress")
                                <span class="badge bg-info px-4 py-3 fs-6">
                                    <i class="bi bi-tools"></i> Sedang Diproses
                                </span>
                            @else
                                <span class="badge bg-success px-4 py-3 fs-6">
                                    <i class="bi bi-check-circle-fill"></i> Selesai
                                </span>
                            @endif
                            <hr>
                            <h6 class="text-muted">Prioritas</h6>
                            @if($ticket->prioritas=="Tinggi")
                                <span class="badge bg-danger px-3 py-2">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Tinggi
                                </span>
                            @elseif($ticket->prioritas=="Sedang")
                                <span class="badge bg-warning text-dark px-3 py-2">
                                    <i class="bi bi-dash-circle-fill me-1"></i> Sedang
                                </span>
                            @else
                                <span class="badge bg-success px-3 py-2">
                                    <i class="bi bi-check-circle-fill me-1"></i> Rendah
                                </span>
                            @endif
                            <hr>
                            <h6 class="text-muted">Dibuat</h6>
                            <strong>{{ $ticket->created_at->format('d F Y') }}</strong><br>
                            <small class="text-muted">{{ $ticket->created_at->format('H:i') }}</small>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="mb-4">
                    <h5 class="fw-bold"><i class="bi bi-card-text text-primary"></i> Deskripsi Permasalahan</h5>
                    <div class="border rounded-3 p-4 bg-white shadow-sm">{{ $ticket->deskripsi }}</div>
                </div>
                <div class="mb-4">
                    <h4 class="fw-bold mb-3"><i class="bi bi-paperclip text-primary"></i> Lampiran</h4>
                    @if($ticket->attachments->count())
                        @foreach($ticket->attachments as $file)
                            <div class="border rounded-3 p-3 d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <i class="bi bi-file-earmark-fill text-primary fs-3"></i>
                                    <span class="ms-2 fw-semibold">{{ $file->nama_file }}</span>
                                </div>
                                <a href="{{ asset('storage/'.$file->path_file) }}" target="_blank" class="btn btn-primary">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-light border">
                            <i class="bi bi-folder2-open"></i> Tidak ada lampiran.
                        </div>
                    @endif
                </div>
                <div class="mt-4">
                    <h4 class="fw-bold mb-3"><i class="bi bi-chat-dots-fill text-primary"></i> Percakapan</h4>
                    <div class="border rounded-4 p-4" style="min-height:350px; background:#f8fafc;">
                        @forelse($ticket->comments as $comment)
                            @php $mine = $comment->user_id == auth()->id(); @endphp
                            <div class="d-flex mb-4 {{ $mine ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="shadow-sm rounded-4 px-4 py-3 {{ $mine ? 'bg-primary text-white' : 'bg-white border-start border-4 border-primary' }}" style="max-width:70%;">
                                    <div class="mb-2">
                                        <div class="d-flex align-items-center mb-1">
                                            @if($mine)
                                                <i class="bi bi-person-circle text-white me-2"></i><strong>Anda</strong>
                                            @else
                                                <i class="bi bi-headset text-primary me-2"></i><strong>{{ $comment->user->name }}</strong>
                                            @endif
                                        </div>
                                        <small class="{{ $mine ? 'text-white-50' : 'text-muted' }}">{{ $comment->created_at->format('d M Y • H:i') }}</small>
                                    </div>
                                    <div class="mt-3">{{ $comment->komentar }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="bi bi-chat-square-dots display-4 text-secondary"></i>
                                <h5 class="mt-3">Belum ada percakapan</h5>
                                <p class="text-muted">Balasan dari petugas akan muncul di sini.</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-circle-fill me-2"></i> {{ $errors->first() }}
                            </div>
                        @endif
                        <form action="{{ route('user.ticket.comment.store', $ticket->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <textarea name="komentar" rows="3" class="form-control rounded-4 shadow-sm" placeholder="Tulis balasan Anda di sini..." required>{{ old('komentar') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="bi bi-send-fill me-1"></i> Kirim Balasan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
