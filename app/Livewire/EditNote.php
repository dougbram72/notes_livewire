<?php

namespace App\Livewire;

use App\Models\Note;
use Flux\Flux;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\On;
class EditNote extends Component
{
    public $title, $content, $noteId;
      #[On('edit-note')]
    public function editNote($id)
    {
        $note = Note::findOrFail($id);
        $this->noteId = $id;
        $this->title = $note->title;
        $this->content = $note->content;
        Flux::modal('edit-note')->show();    
    }
    public function render()
    {
        return view('livewire.edit-note');
    }

    public function update()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('notes', 'title')->ignore($this->noteId)],
            'content' => ['required', 'string'],
        ]);
        
        
        Note::findOrFail($this->noteId)->update([
            'title' => $this->title,
            'content' => $this->content
        ]);
        Flux::modal('edit-note')->close();
        session()->flash('success', 'Note updated successfully.');
        $this->redirectRoute('notes', navigate: true);
    }

}
