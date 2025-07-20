<?php

namespace Tests\Unit;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BoothSelectionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

    public function test_first(){
        $agendaId = '9ee5491a-31d1-4ee0-b8ad-5aef799dd18c';
        $response = $this->get('/admin/booth-selection/' . $agendaId);

        $response->assertStatus(200);
        $response->assertViewIs('admin.boothOrder.booth-selection');
        $response->assertViewHas('agenda', function ($passedAgenda) use ($agenda) {
            return $passedAgenda->id === $agenda->id;
        });
    }

    public function test_second(){

    }
}
