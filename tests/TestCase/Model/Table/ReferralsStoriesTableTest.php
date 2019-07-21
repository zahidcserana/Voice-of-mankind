<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReferralsStoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReferralsStoriesTable Test Case
 */
class ReferralsStoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReferralsStoriesTable
     */
    public $ReferralsStories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.referrals_stories',
        'app.referrals',
        'app.states',
        'app.stories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ReferralsStories') ? [] : ['className' => ReferralsStoriesTable::class];
        $this->ReferralsStories = TableRegistry::get('ReferralsStories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ReferralsStories);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
