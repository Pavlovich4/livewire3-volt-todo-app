<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class TodoForm extends Form
{
    #[Rule('required', message: 'You need to enter a todo')]
    public string $value = '';
}
