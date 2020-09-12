<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{

    /** @test */
    public function LoginInicioSession()
    {

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->post(route('register'), [
                'name' => 'Yepeto',
                'email' => 'Yepeto@gmail.com',
                'password' => '12345678',
            ]);

        /*        $this->assertDatabaseHas('users', [
            'name' => 'Yepeto',
            'email' => 'Yepeto@gmail.com',
            'password' => '12345678',
        ]); */
        $response->assertSRedirect(route('welcom'));
    }
}