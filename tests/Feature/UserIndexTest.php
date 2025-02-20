<?php

use App\Models\User;

it('returns the correct view with expected data', function () {

    $response = $this->get(route('login.index'));
    $response->assertViewIs('modules.login.index')
        ->assertStatus(200);
});

it('testa se o usuario consegue logar', function () {
    $user = User::factory()->createOne();
    $response = $this->post(route('login.process'), [
        'email' => $user->email,
        'password' => 'password'
    ]);
    $response->assertRedirect(route('home.index'))
        ->assertStatus(302);
});