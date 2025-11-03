<?php

test('the application returns a successful response', function () {
    $response = $this->get('/actors');

    $response->assertStatus(200);
});
