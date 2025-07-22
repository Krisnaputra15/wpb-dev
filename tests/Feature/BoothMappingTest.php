<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class BoothMappingTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Auth::login(User::where('role','humas')->first());
    }

    public function test_first(){
        $layoutId = '9ee496f4-bc03-4461-8c98-7f84efca5b78';
        $response = $this->getJson(route('layout.booth.boothMapping', [
            'layoutId' => $layoutId,
            'isTransaction' => 1
        ]));

        $data = $response->json('data');
        $response->assertStatus(200);
        $this->assertNotEmpty($data, 'Data should not be empty');
        $this->assertArrayHasKey('is_booked', $data[0], 'is_booked column is missing');
    }

    public function test_second(){
        $layoutId = '9ee496f4-bc03-4461-8c98-7f84efca5b78';
        $response = $this->getJson(route('layout.booth.boothMapping', [
            'layoutId' => $layoutId,
            'isTransaction' => 0
        ]));

        $data = $response->json('data');
        $response->assertStatus(200);
        $this->assertNotEmpty($data, 'Data should not be empty');
        $this->assertArrayNotHasKey('is_booked', $data[0], 'is_booked column is available');
    }
}
