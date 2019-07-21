<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ListsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ListsTable Test Case
 */
class ListsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ListsTable
     */
    public $Lists;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.lists',
        'app.users',
        'app.categories',
        'app.categories_lists',
        'app.stories',
        'app.categories_stories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Lists') ? [] : ['className' => ListsTable::class];
        $this->Lists = TableRegistry::get('Lists', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Lists);

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
