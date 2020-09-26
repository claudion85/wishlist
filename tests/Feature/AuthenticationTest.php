<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /*test required fields on registration API*/
    public function testRequiredFieldsRegistration(){
        $this->json('POST', 'api/register', ['Accept' => 'application/json'])
        ->assertStatus(422)
        ->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "name" => ["The name field is required."],
                "email" => ["The email field is required."],
                "password" => ["The password field is required."],
            ]
        ]);
        

    }
    
    /*TEST IF EMAIL AND NAME ARE ALREADY REGISTERED*/
    public function testIfEmailExists(){
        $userData = [
            "name" => "John Doe",
            "email" => "doe@example.com",
            "password" => "demo12345",
            
        ];
        $this->json('POST','api/register',$userData,['Accept'=>'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => ["The name has already been taken."],
                    "email" => ["The email has already been taken."],
                   
                ]
            ]);
    }
    
    /* test for successfull registration  */
    public function testSuccessfullyRegistration(){
        $userData = [
            "name" => "John Doe",
            "email" => "doe@example.com",
            "password" => "demo12345",
            
        ];

        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "user" => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
                "access_token",
                
            ]);
    }
    
    /*test for wrong email or passoword login*/
    public function testWrongCredentialsLogin(){
        $userData = [
            "email" => "doedfgdfg@example.com",
            "password" => "demo12345",
            
        ];
        $this->json('POST', 'api/login', $userData, ['Accept' => 'application/json'])
        ->assertStatus(422)
        ->assertJson([
            'message'=>'invalid credentials'
            
        ]);

    }


    /* test for successfully login*/
    public function testSuccessfullyLogin(){
        $userData = [
            "email" => "doe@example.com",
            "password" => "demo12345",
            
        ];
        $this->json('POST', 'api/login', $userData, ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJsonStructure([
            "user" => [
                'id',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
            ],
            "access_token",
            
        ]);
        
    }

    /* test for required fields on login */

    public function testRequiredFieldsOnLogin(){
        $userData = [
            "email" => "",
            "password" => "",
            
        ];
        $this->json('POST', 'api/login', $userData, ['Accept' => 'application/json'])
        ->assertStatus(422)
        ->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
               
                "email" => ["The email field is required."],
                "password" => ["The password field is required."],
            ]
            
        ]);
    }


}
