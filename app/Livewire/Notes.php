<?php

namespace App\Livewire;

use App\Models\Note;
use Flux\Flux;
use Livewire\Component;
use Livewire\WithPagination;

class Notes extends Component
{
    public $noteId;
    use WithPagination;
    public function render()
    {
        $notes = Note::orderByDesc('created_at', 'desc')->paginate(5);
        return view('livewire.notes', compact('notes'));
    }

    public function edit($id)
    {
        $this->dispatch('edit-note',$id);
    }

    public function delete($id)
    {
        $this->noteId = $id;
        Flux::modal('delete-note')->show();

    }

    public function deleteNote()
    {
        Note::findOrFail($this->noteId)->delete();
        Flux::modal('delete-note')->close();
        session()->flash('success', 'Note deleted successfully.');
        $this->redirectRoute('notes', navigate: true);
    }

}
