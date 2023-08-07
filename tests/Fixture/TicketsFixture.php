<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TicketsFixture
 */
class TicketsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'type' => 'Lorem ipsum dolor sit amet',
                'createtime' => '2023-08-07 10:47:58',
                'closetime' => '2023-08-07 10:47:58',
                'cust_id' => 1,
                'staff_id' => 1,
            ],
        ];
        parent::init();
    }
}
