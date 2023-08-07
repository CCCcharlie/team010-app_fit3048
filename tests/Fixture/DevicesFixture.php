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
                'transactionid' => 'fb718813-7bac-466e-b776-85fbcb155b26',
                'device_model' => 'Lorem ipsum dolor sit amet',
                'session_id' => 'Lorem ipsum dolor sit ',
                'technical_details' => 'Lorem ipsum dolor sit amet',
                'cust_id' => 1,
            ],
        ];
        parent::init();
    }
}
