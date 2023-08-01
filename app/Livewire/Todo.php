<?php

namespace App\Livewire;

use App\Livewire\Forms\TodoForm;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;

class Todo extends Component
{
    public array $todos = [];

    public TodoForm $form;

    public bool $completeAll = false;

    #[Url]
    public string $visibility = 'all';

    public function addTodo(): void
    {
        $this->validate();

        $id = $this->allTodoCount > 0 ? $this->all()->last()['id'] + 1 : 1;

        $this->todos[] = [
            'id' => $id,
            'completed' => false,
            'title' => $this->form->value
        ];

        $this->form->reset('value');
    }

    #[Computed]
    public function allTodoCount(): int
    {
        return $this->all->count();
    }

    #[Computed]
    public function remaining()
    {
        return $this->all->filter(fn($todo) => $todo['completed'] == false)->count();
    }

    public function updatedCompleteAll($value)
    {
        $this->todos = $this->all->map(function ($todo) use ($value) {
            $todo['completed'] = $value;

            return $todo;
        })->toArray();

        $this->filteredTodos();
    }

    public function completeTodo(int $id): void
    {
        $this->todos = $this->all->map(function ($todo) use ($id) {

            if ($todo['id'] == $id) {
                $todo['completed'] = true;
            }
            return $todo;
        })->toArray();
    }

    public function removeTodo(int $id): void
    {
        $this->todos = $this->all()->filter(fn($todo) => $todo['id'] != $id)->toArray();
    }



    #[Computed]
    public function all(): Collection
    {
        return collect($this->todos);
    }

    #[Computed]
    public function filteredTodos()
    {
        return match ($this->visibility) {
            'all' => $this->todos,
            'active' => collect($this->todos)->filter(fn($todo) => $todo['completed'] == false)->toArray(),
            'completed' => collect($this->todos)->filter(fn($todo) => $todo['completed'] == true)->toArray(),
        };
    }

    public function render()
    {
        return view('livewire.todo');
    }
}
