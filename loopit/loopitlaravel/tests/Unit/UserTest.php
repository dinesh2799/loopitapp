<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use App\Models\Car;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;
class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function cars()
    {
        $this->assertTrue(true);
    }


public function test_login()
{
    function getName($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString.'@gmail.com';
    }
    $emailid = getName(10);
    User::create([
        'name' => 'Test',
        'email'=> $email = $emailid,
        'password' => $password = 'password',
        'phone' => '1234567890',
    ]);
    $response = $this->json('POST', route('login.user'),['email'=> $email, 'password' => $password]);
    Log::info(1,[$response->getContent()]);
        $response->assertStatus(200);
}
}
