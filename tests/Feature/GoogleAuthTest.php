<?php

namespace Tests\Feature;

use App\Helpers\GAuth;
use Google\AccessToken\Verify;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GoogleAuthTest extends TestCase
{
    private $gauth;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->gauth = new GAuth;
    }

    
    /** @test */
    public function client_is_instance_of_google_client()
    {   
        $this->assertInstanceOf(\Google\Client::class, $this->gauth->client);
    }
    
    /** @test */
    public function token_is_not_expired()
    {
        $client = $this->gauth->client;
        $client->setAccessToken($this->gauth->getToken());

        $this->assertFalse($client->isAccessTokenExpired());
    }

    /** @test */
    public function is_gauth_token_exist()
    {
        $token = $this->gauth->getToken();

        $this->assertIsArray($token);
        $this->assertCount(6, $token);
    }
}
