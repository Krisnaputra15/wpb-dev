<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BoothSelectionStoreTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake();
        Auth::login(User::where('role','perwakilan-perusahaan')->first());
    }

    public function test_first(){
        $payload = [
            'registered_booth_id' => [
                '3f6da3c0-5410-49f6-ad0d-8133941ae585'
            ]
        ];
        $routeParam = '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c';

        $response = $this->post(route('boothOrder.boothSelectionStore', [$routeParam]), $payload);
        $response->assertStatus(302);
    }

    public function test_second(){
        $payload = [
            'registered_booth_id' => [
                '5a65e67b-5a80-418c-af5a-618efcb4c74d'
            ]
        ];
        $routeParam = '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c';

        $response = $this->post(route('boothOrder.boothSelectionStore', [$routeParam]), $payload);
        $response->assertStatus(422);
    }
}
