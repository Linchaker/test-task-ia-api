<?php

use App\Models\Actor;

it('can create an actor via api', function () {
    $payload = [
        'email' => 'tony@example.com',
        'description' => 'My name is Tony Stark. Address Kyiv, Ukraine. I am 20 years old.'
    ];

    $response = $this->postJson('/api/v1/actors', $payload);

    $response->assertStatus(200);

    $this->assertDatabaseHas('actors', [
        'email' => 'tony@example.com',
        'first_name' => 'Tony',
        'last_name' => 'Stark',
        'address' => 'Kyiv, Ukraine',
        'age' => 20
    ]);
});

it('returns validation error if description is missing', function () {
    $response = $this->postJson('/api/v1/actors', [
        'email' => 'tony@example.com',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['description']);
});
