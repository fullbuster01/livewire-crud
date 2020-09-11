<?php

namespace App\Http\Livewire;

use App\Contact;
use Livewire\Component;

class ContactCreate extends Component
{
    public $name, $phone;
    
    public function render()
    {
        return view('livewire.contact-create');
    }

    public function store(){
        $this->validate([
            'name' => 'required|min:3',
            'phone' => 'required|max:15'
        ]);

        $contact = Contact::create([
            'name' => $this->name,
            'phone' => $this->phone
        ]);

        $this->resetInput();

        $this->emit('contactStored', $contact); //ini untuk merefresh data,,  dan untuk contactStored ini ada di listeners pada bagian ContactIndex
    }

    private function resetInput(){
        $this->name = null;
        $this->phone = null;
    }
}
