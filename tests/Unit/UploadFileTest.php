<?php

namespace Tests\Unit;

use App\Helper\GeneralHelper;
use App\Models\Agenda;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadFileTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }
    /**
     * A basic unit test example.
     */
    public function test_first()
    {

        // $agenda = Agenda::factory()->create([
        //     'name' => fake()->words(3, true),
        //     'slug' => fake()->slug(),
        //     'description' => fake()->paragraph(),
        //     'location' => fake()->city(),
        //     'start_date' => now()->addDays(1)->toDateString(),
        //     'end_date' => now()->addDays(10)->toDateString(),
        //     'is_active' => true,
        // ]);

        $file = UploadedFile::fake()->image('cover.png');

        $resultPath = GeneralHelper::uploadFile(Agenda::class, $file, 'images/agenda', '', 'cover', '');

        // ✅ File lama terhapus
        Storage::disk('public')->assertExists($resultPath);
    }

    public function test_second()
    {
        Storage::fake('public');

        // $agenda = Agenda::factory()->create([
        //     'name' => fake()->words(3, true),
        //     'slug' => fake()->slug(),
        //     'description' => fake()->paragraph(),
        //     'location' => fake()->city(),
        //     'start_date' => now()->addDays(1)->toDateString(),
        //     'end_date' => now()->addDays(10)->toDateString(),
        //     'is_active' => true,
        // ]);

        $file = UploadedFile::fake()->image('cover.png');

        $resultPath = GeneralHelper::uploadFile(Agenda::class, $file, 'images/agenda', '', 'cover', 'surat_permohonan');

        // ✅ File lama terhapus
        Storage::disk('public')->assertExists($resultPath);
    }

    public function test_third()
    {
        Storage::fake('public');

        $agenda = Agenda::find('9ee5491a-31d1-4ee0-b8ad-5aef799dd184');
        $old_cover = $agenda->cover;

        $file = UploadedFile::fake()->image('cover.png');

        $resultPath = GeneralHelper::uploadFile(Agenda::class, $file, 'images/agenda', $agenda->id, 'cover', '');

        Storage::disk('public')->assertExists($resultPath);
        Storage::disk('public')->assertMissing($old_cover);
    }

    public function test_fourth()
    {
        Storage::fake('public');

        // Simulasi model ada di DB dan ada file lama
        $agenda = Agenda::find('9ee5491a-31d1-4ee0-b8ad-5aef799dd184');
        $old_cover = $agenda->cover;

        $file = UploadedFile::fake()->image('cover.png');

        $resultPath = GeneralHelper::uploadFile(Agenda::class, $file, 'images/agenda', $agenda->id, 'cover', 'surat_permohonan');

        Storage::disk('public')->assertExists($resultPath);
        Storage::disk('public')->assertMissing($old_cover);
    }
}
