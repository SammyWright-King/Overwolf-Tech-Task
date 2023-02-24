<?php

namespace Tests\Feature;

use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LookupTest extends TestCase
{

    /**
     * @param $response
     * assertions common across all methods
     */
    public function checkAssertOnReturnedData($response)
    {
        $content = json_decode($response->getContent(), true); //convert json to array

        $this->assertArrayHasKey('username', $content); //check array has key username
        $this->assertArrayHasKey('id', $content); //check array has key id
        $this->assertArrayHasKey('avatar', $content); //check array has key avatar

    }

    /**
     * test lookup minecraft with id
     */
    public function test_lookup_minecraft_by_id()
    {
        $response = $this->call('GET', '/lookup', ["type"=>"minecraft", "id" => "d8d5a9237b2043d8883b1150148d6955"]);

        //check that the status code is successful 200 and response is of json structure
        $response->assertStatus(200)
                ->assertSessionHasAll(['id', 'username', 'avatar'])
                ->assertJsonStructure();

        $this->checkAssertOnReturnedData($response);
    }

    /**
     * test lookup minecraft with username
     */
    public function test_lookup_minecraft_by_username()
    {
        $response = $this->call('GET', '/lookup', ["type"=>"minecraft", "username" => "Notch"]);

        //check that the status code is successful 200 and response is of json structure
        $response->assertStatus(200)
            ->assertSessionHasAll(['id', 'username', 'avatar'])
            ->assertJsonStructure();

        $this->checkAssertOnReturnedData($response);
    }


    /**
     * test lookup steam by id
     */
    public function test_lookup_steam_by_id()
    {
        $response = $this->call('GET', '/lookup', ["type"=>"steam", "id" => "76561198806141009"]);

        //check that the status code is successful 200 and response is of json structure
        $response->assertStatus(200)
            ->assertSessionHasAll(['id', 'username', 'avatar'])
            ->assertJsonStructure();

        $this->checkAssertOnReturnedData($response);
    }


    /**
     * test lookup xbl with id
     */
    public function test_lookup_xbl_by_id()
    {
        $response = $this->call('GET', '/lookup', ["type"=>"xbl", "id" => "2533274884045330"]);

        //check that the status code is successful 200 and response is of json structure
        $response->assertStatus(200)
            ->assertSessionHasAll(['id', 'username', 'avatar'])
            ->assertJsonStructure();

        $this->checkAssertOnReturnedData($response);
    }

    /**
     * test lookup xbl with username
     */
    public function test_lookup_xbl_by_username()
    {
        $response = $this->call('GET', '/lookup', ["type"=>"xbl", "username" => "tebex"]);

        //check that the status code is successful 200 and response is of json structure
        $response->assertStatus(200)
            ->assertSessionHasAll(['id', 'username', 'avatar'])
            ->assertJsonStructure();

        $this->checkAssertOnReturnedData($response);
    }
}
