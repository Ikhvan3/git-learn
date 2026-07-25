<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_home_page_can_be_accessed(): void
    {
        $response = $this->get('/');

        $response->assertStatus(201);
    }
}
