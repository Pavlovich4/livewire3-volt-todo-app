<?php

namespace App\Livewire;

use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Counter extends Component
{
    public $count = 1;

    public function increment(): void
    {
        $this->count++;
    }

    public function decrement(): void
    {
        if ($this->count >= 1) {
            $this->count--;
        }
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
