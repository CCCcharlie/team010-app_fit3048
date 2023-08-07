<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CounsellorsFixture
 */
class CounsellorsFixture extends TestFixture
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
                'f_name' => 'Lorem ipsum dolor sit amet',
                'l_name' => 'Lorem ipsum dolor sit amet',
                'notes' => 'Lorem ipsum dolor sit amet',
                'cust_id' => 1,
            ],
        ];
        parent::init();
    }
}
