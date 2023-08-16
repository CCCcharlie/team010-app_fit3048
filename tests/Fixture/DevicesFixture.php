<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DevicesFixture
 */
class DevicesFixture extends TestFixture
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
                'transactionid' => 'Lorem ',
                'device_model' => 'Lorem ipsum dolor sit amet',
                'sessionid' => 'Lorem ipsum dolor sit ',
                'technical_details' => 'Lorem ipsum dolor sit amet',
                'platform' => 'Lorem ipsum dolor ',
                'gamblock_ver' => 'Lorem ipsum dolor sit amet',
                'cust_id' => 1,
            ],
        ];
        parent::init();
    }
}
