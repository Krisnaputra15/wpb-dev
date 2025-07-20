<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class EditBoothTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Auth::login(User::where('role','humas')->first());
    }

    public function test_first(){
        $transactionId = '9f702ec9-f7f0-48e4-9f3f-08c233bbd910';
        $response = $this->get(route('boothTransaction.editBooth',[$transactionId]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.transaction.editBooth');
    }

    public function test_second(){
        $transactionId = '9ee5491a-31d1-4ee0-b8ad-5aef799dd156';
        $response = $this->get(route('boothTransaction.editBooth',[$transactionId]));

        $response->assertStatus(404);
    }
}
