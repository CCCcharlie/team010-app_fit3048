<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'age' => 1,
                'email' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'timezone' => 'Lorem ipsum dolor sit amet',
                'admin_status' => 1,
                'nonce' => '',
                'nonce_expiry' => 1691405271,
            ],
        ];
        parent::init();
    }
}
