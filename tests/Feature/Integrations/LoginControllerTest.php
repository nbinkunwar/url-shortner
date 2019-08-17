<?php

namespace Tests\Feature\Integrations;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{

    /**
     * @test
     *
     * @covers ::login
     */
    public function it_throws_validation_exception_for_invalid_requests()
    {
        $response = $this->json('post','/api/v1/login',[]);
        $this->assertEquals([
            'message'=>'The given data was invalid.',
            'errors' => [
                'email' => [
                    'The email field is required.',
                ],
                'password' => [
                    'The password field is required.',
                ],
            ],
        ], json_decode($response->getContent(),1));

        $this->assertEquals(422,$response->status());
    }

    /**
     * @test
     *
     * @covers ::login
     */
    public function it_fails_login_for_invalid_user()
    {
        $response = $this->json('post','/api/v1/login',[
            'email'=>'admin@admin.com',
            'password'=>'invalid'
        ]);
        $this->assertEquals([
            'data' => [
                'message' => 'Invalid email or password'
            ],
        ], json_decode($response->getContent(),1));

        $this->assertEquals(401,$response->status());
    }


    /**
     * @test
     *
     * @covers ::login
     */
    public function it_authenticates_user()
    {
        $response = $this->json('post','/api/v1/login',[
            'email'=>'admin@admin.com',
            'password'=>'password'
        ]);
        $content = json_decode($response->getContent(),1);
        $this->assertEquals(200,$response->status());
        $this->assertNotEmpty($content['token']);
    }
}
