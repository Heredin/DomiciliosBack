<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LoginTest extends TestCase
{
    #[Test]
    public function an_existing_user_can_login()
    {
        //$this->withExceptionHandling();
        $credentials = ['email' => 'heredin@gmail.com', 'password' => 'heredin1'];

        $response = $this->post("{$this->apiBase}/login", $credentials);
        $response->dump();
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token']]);
    }
    public function an_non_existing_user_cannot_login()
    {
        $credentials = ['email' => 'heredinfail@gmail.com', 'password23' => 'heredin1'];

        $response = $this->post("{$this->apiBase}/login", $credentials);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token']]);
    }
    public function email_must_be_required()
    {
        $credentials = ['password' => 'heredin1'];

        $response = $this->post("{$this->apiBase}/login", $credentials);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token']]);
    }
    public function password_must_be_required()
    {
        $credentials = ['email' => 'heredinfail@gmail.com'];

        $response = $this->post("{$this->apiBase}/login", $credentials);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token']]);
    }
}
