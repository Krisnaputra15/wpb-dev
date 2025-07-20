<?php

namespace Tests\Unit;

use App\Helper\GeneralHelper;
use App\Models\Agenda;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class InsertRegisteredBoothTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

    public function test_first() {
        $columnValue = '9ee68551-17ac-4371-a8cf-bed888d0ed3b';
        $columnToSearch = 'bl.id';
        $agenda = Agenda::find('9ee5491a-31d1-4ee0-b8ad-5aef799dd18c');

        $insert = GeneralHelper::insertRegisteredBooth($columnToSearch, $columnValue, $agenda);

        $this->assertDatabaseHas('registered_booths', [
            'agenda_id' => $agenda->id,
            'booth_layout_id' => $columnValue,
        ]);
    }

    public function test_second(){
        $columnValue = '9ee68551-17ac-4371-a8cf-bed888d0bgh1';
        $columnToSearch = 'bl.id';
        $agenda = Agenda::find('9ee5491a-31d1-4ee0-b8ad-5aef799dd18c');

        $insert = GeneralHelper::insertRegisteredBooth($columnToSearch, $columnValue, $agenda);

        $this->assertDatabaseMissing('registered_booths', [
            'agenda_id' => $agenda->id,
            'booth_layout_id' => $columnValue,
        ]);
    }
}
