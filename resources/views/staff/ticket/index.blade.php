<form action="{{ route('admin.ticket.update', $ticket->id) }}" method="POST" class="d-flex gap-2">
    @csrf
    @method('PUT')

    <select name="status" class="form-select form-select-sm">
        <option value="To Do" {{ $ticket->status=='To Do' ? 'selected' : '' }}>To Do</option>
        <option value="In Progress" {{ $ticket->status=='In Progress' ? 'selected' : '' }}>In Progress</option>
        <option value="Done" {{ $ticket->status=='Complete' ? 'selected' : '' }}>Complete</option>
    </select>

    <button class="btn btn-sm btn-primary">
        Simpan
    </button>
</form>