<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CatastroApiTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->actingAs(User::find(1));

        $response = $this->get('/api/price-m2/zip-codes/sdfsdf/aggregate/dfg?construction_type=a');
        $response->assertStatus(422);

        $secondResponse = $this->get('/api/price-m2/zip-codes/7770/aggregate/avg?construction_type=2');
        $secondResponse->assertStatus(200);
    }
}
