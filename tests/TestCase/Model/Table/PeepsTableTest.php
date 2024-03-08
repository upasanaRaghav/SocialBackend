<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PeepsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PeepsTable Test Case
 */
class PeepsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PeepsTable
     */
    public $Peeps;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Peeps',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Peeps') ? [] : ['className' => PeepsTable::class];
        $this->Peeps = TableRegistry::getTableLocator()->get('Peeps', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Peeps);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
