<?php

namespace Tests\Unit;

use App\Models\BoothLayout;
use Tests\TestCase;

class GetBoothLayoutTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_first(){
        $columns = ['bl.id', 'positions', 'type'];
        $comparedColumns = ['id', 'positions', 'type'];
        $layoutId = '9ee496f4-bc03-4461-8c98-7f84efca5b78';
        $isTransaction = 1;

        $boothLayoutSql = BoothLayout::getBoothLayout($columns, $layoutId, $isTransaction);

        $this->assertStringContainsString('join `booths` as `b` on `b`.`id` = `bl`.`booth_id`', $boothLayoutSql->toSql());
        $this->assertStringContainsString('left join `registered_booths` as `rb` on `rb`.`booth_layout_id` = `bl`.`id`', $boothLayoutSql->toSql());
        $this->assertStringContainsString('left join `booth_transactions` as `bt` on `bt`.`id` = `rb`.`booth_transaction_id`', $boothLayoutSql->toSql());
        $this->assertStringContainsString('left join `agenda_participants` as `ap` on `ap`.`id` = `bt`.`participant_id`', $boothLayoutSql->toSql());
        $this->assertStringContainsString('left join `users` as `u` on `u`.`id` = `ap`.`user_id`', $boothLayoutSql->toSql());
        $this->assertStringContainsString('left join `companies` as `c` on `c`.`id` = `u`.`company_id`', $boothLayoutSql->toSql());
        $this->assertEquals(
            $comparedColumns,
            array_keys($boothLayoutSql->first()->toArray())
        );
    }

    public function test_second(){
        $columns = ['bl.id', 'positions', 'type'];
        $comparedColumns = ['id', 'positions', 'type'];
        $layoutId = '9ee496f4-bc03-4461-8c98-7f84efca5b78';
        $isTransaction = 1;

        $boothLayoutSql = BoothLayout::getBoothLayout($columns, $layoutId, $isTransaction);

        $this->assertStringContainsString('join `booths` as `b` on `b`.`id` = `bl`.`booth_id`', $boothLayoutSql->toSql());
        $this->assertEquals(
            $comparedColumns,
            array_keys($boothLayoutSql->first()->toArray())
        );
    }
}
