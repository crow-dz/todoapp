<?php

namespace App\Livewire;

use App\Models\Note;
use App\Models\User;
use Error;
use Exception;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;


class TodoList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    public $user;
    #[Rule('required|min:3')]
    public $content;
    #[Rule('required|min:3')]
    public $newContent;
    public $userid;

    public $search;

    public $updatedTodoId;

    public function mount()
    {
        $this->user = User::find(1);
    }

    public function openEdit($todoId)
    {
        $this->updatedTodoId = $todoId;
        $this->newContent = Note::find($todoId)->content;

    }

    public function closeEdit()
    {
        $this->reset('updatedTodoId');

    }


    public function updateTodo()
    {
        $this->validateOnly('newContent');

        Note::find($this->updatedTodoId)->update(['content' => $this->newContent]);

        $this->reset('updatedTodoId');
    }

    public function createTodo()
    {

        $this->validateOnly('content');
        Note::create([
            'content' => $this->content,
            'user_id' => $this->userid,
            'is_completed' => false,
            'create_at' => now()
        ]);
        request()->session()->flash("success", "Created.");
        $this->reset(['content']);

    }

    public function updatedSelected()
    {
        $this->perPage = 10;
    }

    public function deleteTodo($todoId)
    {
        try {
            $todo = Note::findOrFail($todoId);
            $todo->delete();

        } catch (Exception $e) {
            session()->flash('error', "Failed to delete.");
            return;
        }
        ;
    }
    public function toggleComplete($todoId)
    {

        $todo = Note::find($todoId);
        $todo->is_completed = !$todo->is_completed;
        $todo->save();
    }


    public function render()
    {
        $todos = Note::latest()->where('content', 'like', "%{$this->search}%")->paginate(10);

        return view('livewire.todo-list', [
            'user' => $this->user,
            'todos' => $todos
        ]);

    }
}
