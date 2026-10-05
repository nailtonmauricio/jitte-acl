<?php

it('nao permite acesso ao dashboard para usuarios nao autenticados', function () {
    $response = $this->get(route('home.index'));

    $response->assertRedirect(route('login.index'));
});
