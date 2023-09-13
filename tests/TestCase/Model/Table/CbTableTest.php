<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CbTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CbTable Test Case
 */
class CbTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CbTable
     */
    protected $Cb;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Cb',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Cb') ? [] : ['className' => CbTable::class];
        $this->Cb = $this->getTableLocator()->get('Cb', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Cb);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CbTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
