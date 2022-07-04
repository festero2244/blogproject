<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_renders_the_homepage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
