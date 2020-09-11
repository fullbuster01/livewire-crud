<div>
    <form wire:submit.prevent="update">
        <input type="hidden" wire:model="contactId">
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input wire:model="name" type="text" class="form-control" id="name" placeholder="Name">
                    @error('name')
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input wire:model="phone" type="text" class="form-control" id="phone" placeholder="Phone">
                    @error('phone')
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
