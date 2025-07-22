<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateBoothTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake();
        Auth::login(User::where('role','humas')->first());
    }

    public function test_first(){
        $payload = [
            'registered_booth_id' => [
                'e9f43bd1-9903-4a1e-a7b4-fc214ccaa0f2'
            ]
        ];
        $routeParam = '9f702ec9-f7f0-48e4-9f3f-08c233bbd910';

        $response = $this->put(route('boothTransaction.updateBooth', [$routeParam]), $payload);
        $response->assertStatus(422);
    }

    public function test_second(){
        $payload = [
            'registered_booth_id' => [
                '5a65e67b-5a80-418c-af5a-618efcb4c74d'
            ]
        ];
        $routeParam = '9f702ec9-f7f0-48e4-9f3f-08c233bbd910';

        $response = $this->put(route('boothTransaction.updateBooth', [$routeParam]), $payload);
        $response->assertStatus(500);
        $response->assertSessionHas('error');
    }

    public function test_third(){
        $payload = [
            'registered_booth_id' => [
                '06ce6702-1f1f-4a4e-8e3b-ec2814944a19'
            ]
        ];
        $routeParam = '9f702ec9-f7f0-48e4-9f3f-08c233bbd910';

        $response = $this->put(route('boothTransaction.updateBooth', [$routeParam]), $payload);
        $response->assertStatus(200);
        $response->assertSessionHas('success');
    }
}
