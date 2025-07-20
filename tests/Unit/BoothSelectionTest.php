<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BoothSelectionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        Auth::login(User::where('role','perwakilan-perusahaan')->first());
    }

    public function test_first(){
        $agendaId = '9ee5491a-31d1-4ee0-b8ad-5aef799dd184';
        $response = $this->get(route('boothOrder.boothSelection',[$agendaId]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.boothOrder.booth-selection');
        $response->assertViewHas('agenda', function ($passedAgenda) use ($agendaId) {
            return $passedAgenda->id === $agendaId;
        });
    }

    public function test_second(){
        $agendaId = '9ee5491a-31d1-4ee0-b8ad-5aef799dd156';
        $response = $this->get(route('boothOrder.boothSelection',[$agendaId]));

        $response->assertStatus(404);
    }
}
