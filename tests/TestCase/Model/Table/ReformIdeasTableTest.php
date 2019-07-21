<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReformIdeasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReformIdeasTable Test Case
 */
class ReformIdeasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReformIdeasTable
     */
    public $ReformIdeas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reform_ideas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ReformIdeas') ? [] : ['className' => ReformIdeasTable::class];
        $this->ReformIdeas = TableRegistry::get('ReformIdeas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReformIdeas);

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
}
