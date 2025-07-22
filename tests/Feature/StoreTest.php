<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoreTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake();
        Auth::login(User::where('role','administrator')->first());
    }

    public function test_first() {
        $file = UploadedFile::fake()->image('cover.png');
        $payload = [
            'positions' => ['1_5','1_6','1_7'],
            'booth_pov_file' => $file,
            'booth_id' => '9ee49151-89fc-4543-b752-aae6453a300f',
            'need_label' => 1
        ];
        $layoutId = '9ef60fcd-5eec-492e-a8cc-414e86c0a3b1';

        $payload['layout_id'] = $layoutId;

        $response = $this->post(route('layout.booth.store',[$layoutId]), $payload);

        $response->assertStatus(422);

    }

    public function test_second() {
        $file = UploadedFile::fake()->image('cover.png');
        $payload = [
            'positions' => json_encode(['1_5','1_6','1_7']),
            'label' => '01',
            'need_label' => 1,
            'booth_pov_file' => $file,
            'booth_id' => '9ee49151-89fc-4543-b752-aae6453a300f',
        ];
        $layoutId = '9ef60fcd-5eec-492e-a8cc-414e86c0a3b1';

        $payload['layout_id'] = $layoutId;

        $response = $this->post(route('layout.booth.store',[$layoutId]), $payload);

        $response->assertStatus(201);
    }

    public function test_third() {
        $file = UploadedFile::fake()->image('cover.png');
        $payload = [
            'positions' => json_encode(['1_5','1_6','1_7']),
            'label' => '01',
            'need_label' => 1,
            'booth_pov_file' => $file,
            'booth_id' => '9ee49151-89fc-4543-b752-aae6453a300f',
        ];
        $layoutId = '9ef60fcd-5eec-492e-a8cc-414e86c0a3b1';

        $payload['layout_id'] = $layoutId;

        $response = $this->post(route('layout.booth.store',[$layoutId]), $payload);

        $response->assertStatus(201);
    }
}
