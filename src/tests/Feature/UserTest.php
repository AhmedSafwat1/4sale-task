<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class UserTest extends TestCase
{
    public $baseUrl="/api/v1/users/";

    /**
     * Call users api
     */
    public function test_call_users_api_status_success(): void
    {

        $response = $this->get($this->baseUrl);
        $response->assertStatus(200)
        ->assertJson([
            'status' => "success",
        ]);
    }

    /**
    * Call users api
    */
    public function test_call_users_api_status_success_with_filter_provider(): void
    {

        $response = $this->call("get", $this->baseUrl, ["provider"=>"DataProviderY"]);
        $response->assertStatus(200)
        ->assertJson([
            'status' => "success",
        ]);
        $this->assertEquals("DataProviderY", $response->json()['data'][0]["provider"]);
    }

    /**
    * Call users api
    */
    public function test_call_users_api_status_success_with_filter_StatusCode(): void
    {

        $response = $this->call("get", $this->baseUrl, ["statusCode"=>"authorised"]);
        $response->assertStatus(200)
        ->assertJson([
            'status' => "success",
        ]);
        $this->assertEquals("authorised", $response->json()['data'][0]["status"]);
    }
}
