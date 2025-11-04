<?php

use App\Models\Actor;
use App\Services\Actor\Contracts\ActorDataParserInterface;

beforeEach(function () {
    $mock = Mockery::mock(ActorDataParserInterface::class);
    $mock->shouldReceive('parse')
        ->andReturn([
            'first_name' => 'Tony',
            'last_name' => 'Stark',
            'address' => 'Kyiv, Ukraine',
            'age' => 20,
        ]);
    $mock->shouldReceive('getDefaultParserPrompt')
        ->andReturn('Prompt text');

    $this->app->instance(ActorDataParserInterface::class, $mock);
});

it('can create an actor via api', function () {
    $payload = [
        'email' => 'tony@example.com',
        'description' => 'My name is Tony Stark. Address Kyiv, Ukraine. I am 20 years old.'
    ];

    $response = $this->postJson('/api/v1/actors', $payload);

    $response->assertNoContent();

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

it('returns parser prompt successful', function () {
    $response = $this->getJson('/api/v1/actors/prompt-validation');

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Prompt text',
        ]);
});
