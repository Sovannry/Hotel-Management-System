<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_guest_is_redirected_to_login_from_the_homepage(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('login'));
    }

    public function test_login_page_loads_with_the_compiled_hotel_stylesheet(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('/build/assets/hotel-', false);
    }

    public function test_register_page_loads_with_the_compiled_hotel_stylesheet(): void
    {
        $this->get(route('register'))
            ->assertOk()
            ->assertSee('/build/assets/hotel-', false);
    }
}
