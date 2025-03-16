<?php

namespace App\Livewire;

use App\Models\Note;
use App\Models\User;
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

    public $userid;

    public $search;

    public function mount()
    {
        $this->user = User::find(1);
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



    public function deleteTodo(Note $todo)
    {
        $todo->delete();
    }
    public function toggleComplete($todoId)
    {

        $todo = Note::find($todoId);
        $todo->is_completed = !$todo->is_completed;
        $todo->save();
    }


    public function render()
    {
        $todos = Note::latest()->where('content', 'like', "%{$this->search}%")->paginate(5);

        return view('livewire.todo-list', [
            'user' => $this->user,
            'todos' => $todos
        ]);

    }
}
