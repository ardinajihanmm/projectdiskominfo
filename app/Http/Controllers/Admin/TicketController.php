<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function index()
    {
        return view('admin.ticket.index');
    }

    public function show($id)
    {
        return view('admin.ticket.detail');
    }

    public function edit($id)
    {
        return view('admin.ticket.edit');
    }
}