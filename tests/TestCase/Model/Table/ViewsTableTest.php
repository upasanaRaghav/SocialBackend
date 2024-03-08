<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ViewsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ViewsTable Test Case
 */
class ViewsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ViewsTable
     */
    public $Views;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Views',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Views') ? [] : ['className' => ViewsTable::class];
        $this->Views = TableRegistry::getTableLocator()->get('Views', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Views);

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
