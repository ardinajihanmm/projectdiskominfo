<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return view('user.ticket.history');
    }

    public function create()
    {
        return view('user.ticket.create');
    }

    public function store(Request $request)
    {
        // Simpan pengajuan
    }

    public function show($id)
    {
        return view('user.ticket.detail');
    }
}