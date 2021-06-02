<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use DB;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthTest extends TestCase
{
    // use DatabaseMigrations;
    // use RefreshDatabase;

    public static function getUser()
    {
        $user = User::factory()->create([
            'password' => Hash::make('test123'),
            'type' => 'T/F',
            'email_verified_at' => Carbon::now()
        ]);

        return $user;
    }

    protected function callApi($type = 'GET', String $endpoint)
    {
        DB::table('users')->truncate();
        $user = self::getUser();
        
        $token = JWTAuth::fromUser($user);
        $response = $this->json($type, $endpoint, [], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ]);

        return $response;
    }
    
    // E:/xampp/htdocs/laravelapps/laravel5/sfmdsmark/tests/Feature/Api/AuthTest.php
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_api_user_login_successfull()
    {
        DB::table('users')->truncate();
        $user = User::factory()->create([
            'password' => Hash::make('test123'),
            'type' => 'T/F',
            'email_verified_at' => Carbon::now()
        ]);

        $response = $this->json('POST', $this->base_url() . '/auth/login', [
            'email' => $user->email,
            'password' => 'test123'
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => ['access_token', 'token_type', 'expires_in'],
            'success',
            'message'
        ]);
    }

    public function test_api_user_logout_successfull()
    {
        $response = $this->callApi('POST', $this->base_url() . '/auth/logout');
        $response->assertStatus(200);
    }

    public function test_api_user_login_fail()
    {
        DB::table('users')->truncate();
        $user = User::factory()->create([
            'password' => Hash::make('test123'),
            'type' => 'T/F',
            'email_verified_at' => Carbon::now()
        ]);

        $response = $this->json('POST', $this->base_url() . '/auth/login', [
            'email' => $user->email,
            'password' => 'test1234'
        ], ['Accept' => 'application/json']);

        $response->assertStatus(401);
    }

    public function test_api_get_user_data_successfull()
    {
        $response = $this->callApi('get', $this->base_url() . '/user');
        $response->assertStatus(200);
    }

    public function test_api_get_user_data_failed()
    {
        $token = rand(1, 100);
        $response = $this->json('get', $this->base_url() . '/internal-admin/me', [], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ]);
        $response->assertStatus(401);
    }

    public function base_url():string
    {
        return config('app.url') . '/api';
    }
}
