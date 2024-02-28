<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

test('should be able to create a new question bigger than 255 characters', function () {
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260). '?'
    ]);

    $request->assertRedirectToRoute('dashboard');
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260). '?'
    ]);
});

test('should have at least 10 characters', function () {
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8). '?'
    ]);

    $request->assertSessionHasErrors([
        'question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])
    ]);

    assertDatabaseCount('questions', 0);
});
