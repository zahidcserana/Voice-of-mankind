<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StoriesTable Test Case
 */
class StoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StoriesTable
     */
    public $Stories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.stories',
        'app.users',
        'app.agencies',
        'app.states',
        'app.referrals',
        'app.referrals_stories',
        'app.comments',
        'app.media',
        'app.ratings',
        'app.categories',
        'app.lists',
        'app.categories_lists',
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
        $config = TableRegistry::exists('Stories') ? [] : ['className' => StoriesTable::class];
        $this->Stories = TableRegistry::get('Stories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Stories);

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
