<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class NoteList extends Component
{
    use WithPagination;
    #[Validate('required', message: "please add your note")]
    public $body = '';
    public $updating = false;
    public $noteToUpdate;

    public function saveNote()
    {
        $this->validate();
        Note::create([
            'body' => $this->body
        ]);
        $this->cleardata();
    }
    public function editNote(Note $note)
    {
        $this->updating = true;
        $this->noteToUpdate = $note;
        $this->body = $note->body;
    }
    public function updateNote()
    {
        $this->validate();
        $this->noteToUpdate->update([
            'body' => $this->body,
        ]);
        $this->cleardata();
    }
    public function noteDone()
    {
        $this->noteToUpdate->update([
            'done' => 1
        ]);
        $this->cleardata();
    }
    public function noteDelete(Note $note)
    {

        $note->delete();
        $this->cleardata();
    }
    public function cleardata()
    {
        $this->body = '';
        if ($this->updating) {
            $this->updating = false;
            $this->noteToUpdate = null;
        }
        $this->resetValidation();
    }


    public function render()
    {
        return view('livewire.note-list', [
            'notes' => Note::latest()->simplePaginate(3)
        ]);
    }
}
