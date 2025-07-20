<?php

namespace Tests\Unit;

use App\Helper\GeneralHelper;
use Tests\TestCase;

class CalculateAdditionalFeeTest extends TestCase
{

    public function test_first()
    {
        $mockSetting = (object)[
            'additional_fee_settings' => json_encode([
                'fee_name' => ['PPN'],
                'fee_type' => ['formula'],
                'fee_tax_type' => ['tax'],
                'fee_value' => ['10/100*{}']
            ])
        ];

        \Mockery::mock('alias:App\\Models\\Setting')
            ->shouldReceive('first')
            ->once()
            ->andReturn($mockSetting);

        $result = GeneralHelper::calculateAdditionalFee(1000000);

        $this->assertEquals([
            [
                'name' => 'PPN',
                'tax_type' => 'tax',
                'amount' => 100000
            ]
        ], $result);
    }

    public function test_second() {
        $mockSetting = (object)[
            'additional_fee_settings' => json_encode([
                'fee_name' => ['PPN'],
                'fee_type' => ['percentage'],
                'fee_tax_type' => ['tax'],
                'fee_value' => [10]
            ])
        ];

        \Mockery::mock('alias:App\\Models\\Setting')
            ->shouldReceive('first')
            ->once()
            ->andReturn($mockSetting);

        $result = GeneralHelper::calculateAdditionalFee(1000000);

        $this->assertEquals([
            [
                'name' => 'PPN',
                'tax_type' => 'tax',
                'amount' => 100000
            ]
        ], $result);
    }

    public function test_third() {
        $mockSetting = (object)[
            'additional_fee_settings' => json_encode([
                'fee_name' => ['PPN'],
                'fee_type' => ['exact'],
                'fee_tax_type' => ['tax'],
                'fee_value' => [10000]
            ])
        ];

        \Mockery::mock('alias:App\\Models\\Setting')
            ->shouldReceive('first')
            ->once()
            ->andReturn($mockSetting);

        $result = GeneralHelper::calculateAdditionalFee(1000000);

        $this->assertEquals([
            [
                'name' => 'PPN',
                'tax_type' => 'tax',
                'amount' => 10000
            ]
        ], $result);
    }

    public function test_fourth() {
        $mockSetting = (object)[
            'additional_fee_settings' => json_encode([
                'fee_name' => [],
                'fee_type' => [],
                'fee_tax_type' => [],
                'fee_value' => []
            ])
        ];

        \Mockery::mock('alias:App\\Models\\Setting')
            ->shouldReceive('first')
            ->once()
            ->andReturn($mockSetting);

        $result = GeneralHelper::calculateAdditionalFee(1000000);

        $this->assertEquals([], $result);
    }

    public function test_fifth() {
        $mockSetting = (object)[
            'additional_fee_settings' => json_encode([])
        ];

        \Mockery::mock('alias:App\\Models\\Setting')
            ->shouldReceive('first')
            ->once()
            ->andReturn($mockSetting);

        $result = GeneralHelper::calculateAdditionalFee(1000000);

        $this->assertEquals([], $result);
    }
}
