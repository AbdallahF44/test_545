<div style="display: flex;gap: 5px" wire:poll>
    <button wire:click="increment()" type="button">+</button>
    <h1>{{ $count }}</h1>
    <button wire:click="decrement()" type="button">-</button>
</div>

