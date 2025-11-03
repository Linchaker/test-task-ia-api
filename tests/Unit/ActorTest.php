<?php

use App\Models\Actor;

it('can create an actor with required fields', function () {
    $actor = Actor::factory()->create([
        'email' => 'tony@example.com',
        'first_name' => 'Tony',
        'last_name' => 'Stark',
        'address' => 'Kyiv, Ukraine',
    ]);

    expect($actor)->toBeInstanceOf(Actor::class)
        ->and($actor->email)->toBe('tony@example.com')
        ->and($actor->first_name)->toBe('Tony')
        ->and($actor->last_name)->toBe('Stark')
        ->and($actor->address)->toBe('Kyiv, Ukraine');
});
