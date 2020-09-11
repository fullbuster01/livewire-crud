<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
        {{ session()->get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    @endif
    @if ($statusUpdate)
        <livewire:contact-update></livewire:contact-update>
    @else
        <livewire:contact-create></livewire:contact-create>
    @endif
    <hr>

    <div class="row">
        <div class="col">
            <select wire:model="paginate" class="form-control form-control-sm sm w-auto">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
        </div>
        <div class="col">
            <input wire:model="search" type="text" class="form-control form-control-sm" placeholder="Search">
        </div>
    </div>

    <hr>

    <table class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contacts as $contact)
            <tr>
                <td>{{ $loop->iteration + ($contacts->currentPage() * $paginate - $paginate)}}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->phone }}</td>
                <td>
                    <button wire:click="getContact({{ $contact->id }})" class="btn btn-success btn-sm">Edit</button>
                    <button wire:click="destroy({{ $contact->id }})" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{ $contacts->links() }}
    </div>
</div>