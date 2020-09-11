<?php

namespace App\Http\Livewire;

use App\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactIndex extends Component
{
    use WithPagination;

    public $statusUpdate = false;
    public $paginate = 5;
    public $search;

    protected $listeners = [
        'contactStored' => 'handleStore',
        'contactUpdated' => 'handleUpdate'
    ];

    // ini untuk update jika user melakukan search diurl
    protected $updatesQueryString = ['search'];
    public function mount(){ //mount ini seperti construct
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        
        $contacts = $this->search == null ? Contact::latest()->paginate($this->paginate) : Contact::where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate);
        // $contacts = $this->search == null ? Contact::latest()->paginate($this->paginate) : Contact::where('phone', 'like', '%' . $this->search . '%')->paginate($this->paginate);
        return view('livewire.contact-index', compact('contacts'));
    }

    //menampilkan data yg ingin diedit
    public function getContact($id)
    {
        $this->statusUpdate = true; //untuk validasi merubah views diindex
        $contact = Contact::findOrFail($id);
        $this->emit('getContact', $contact);
    }

    //menghapus data
    public function destroy($id){
        if ($id) {
            $contact = Contact::findOrFail($id);
            $contact->delete();
            session()->flash('success', 'Contact ' . $contact['name'] . ' Berhasil Dihapus!');
        }
    }

    public function handleStore($contact)
    {
        session()->flash('success', 'Contact ' . $contact['name'] . ' Berhasil Ditambahkan!');
    }

    public function handleUpdate($contact)
    {
        session()->flash('success', 'Contact ' . $contact['name'] . ' Berhasil Diubah!');
    }
}
