<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ContentsFixture
 */
class ContentsFixture extends TestFixture
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
                'content' => 'Lorem ipsum dolor sit amet',
                'createtime' => '2023-08-11 05:28:33',
                'ticket_id' => 1,
                'content_type' => 'Lorem ip',
            ],
        ];
        parent::init();
    }
}
