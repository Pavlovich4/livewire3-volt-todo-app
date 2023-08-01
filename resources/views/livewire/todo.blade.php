<div>
    <section class="todoapp">
        <header class="header">
            <h1>todos</h1>
            <input
                autofocus="autofocus"
                autocomplete="off"
                placeholder="What needs to be done?"
                class="new-todo"
                wire:model="form.value"
                wire:keyup.enter="addTodo"
            >
            <div style="color: #b83f45; padding-left: 5px">@error('form.value') {{ $message }} @enderror</div>
        </header>

        <section class="main">
            <input id="toggle-all" type="checkbox" class="toggle-all" wire:model.live="completeAll">
            <label for="toggle-all">Mark all as complete</label>
            <ul class="todo-list">
                @foreach($this->filteredTodos as $todo)

                    <li class="todo {{ $todo['completed'] ? 'completed' : '' }}" wire:key="{{ $todo['id'] }}">
                        <div class="view">
                            <input type="checkbox" class="toggle" wire:model.live="todos.{{array_search($todo, $todos)}}.completed">
                            <label>{{ $todo['title'] }}</label>
                            <button class="destroy" wire:click.prevent="removeTodo({{ $todo['id'] }})"></button>
                        </div>
                        <input type="text" class="edit">
                    </li>
                @endforeach
            </ul>
        </section>
        <footer class="footer">
            <span class="todo-count">
                <strong>{{ $this->remaining }}</strong> items left
            </span>
            <ul class="filters">
                <li><a href="#/all" wire:click.prevent="$set('visibility', 'all')" class="{{ $visibility == 'all' ? 'selected' : '' }}">All</a></li>
                <li><a href="#/active" wire:click.prevent="$set('visibility', 'active')" class="{{ $visibility == 'active' ? 'selected' : '' }}">Active</a></li>
                <li><a href="#/completed" wire:click.prevent="$set('visibility', 'completed')" class="{{ $visibility == 'completed' ? 'selected' : '' }}">Completed</a></li>
            </ul>
            <button class="clear-completed" style="display: none;">
                Clear completed
            </button>
        </footer>
    </section>
</div>
