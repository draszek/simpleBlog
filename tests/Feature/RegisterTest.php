<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A Basic test for checking if register work.
     *
     * @return void
     */
    public function testRegister()
    {
        $this->withoutExceptionHandling();

        $data = (factory(User::class)->make())->getAttributes();
        $data['password_confirmation'] = $data['password'];
        $response = $this->post('/api/register', $data);

        $response->assertStatus(200);
        $this->assertCount(1, User::all());
    }
}
