<?php

namespace App\Livewire;

use App\Models\Note;
use Flux\Flux;
use Livewire\Component;

class CreateNote extends Component
{
    public $title;
    public $content ;

    protected function rules()
    {
        return [
            'title' => 'required|string|unique:notes,title|max:255',
            'content' => 'required|string',
        ];
    }

    public function save()
    {
        $this->validate();
       Note::create([
           'title' => $this->title,
           'content' => $this->content
       ]);

       $this->reset();
       Flux::modal('create-note')->close();
       session()->flash('success', 'Note created successfully.');
       $this->redirectRoute('notes', navigate: true);
    }
    public function render()
    {
       
        return view('livewire.create-note');
    }
}
