<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test root URL redirects to /home.
     */
    public function test_the_root_redirects_to_home(): void
    {
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }
}
