<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CounsellorsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CounsellorsTable Test Case
 */
class CounsellorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CounsellorsTable
     */
    protected $Counsellors;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Counsellors',
        'app.Customers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Counsellors') ? [] : ['className' => CounsellorsTable::class];
        $this->Counsellors = $this->getTableLocator()->get('Counsellors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Counsellors);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CounsellorsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CounsellorsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
