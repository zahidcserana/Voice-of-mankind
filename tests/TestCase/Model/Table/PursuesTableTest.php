<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PursuesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PursuesTable Test Case
 */
class PursuesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PursuesTable
     */
    public $Pursues;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.pursues',
        'app.referrals',
        'app.states',
        'app.countries',
        'app.users',
        'app.user_types',
        'app.agencies',
        'app.counties',
        'app.cities',
        'app.stories',
        'app.reform_ideas',
        'app.comments',
        'app.media',
        'app.ratings',
        'app.categories',
        'app.my_lists',
        'app.categories_lists',
        'app.lists',
        'app.categories_stories',
        'app.referrals_stories',
        'app.professions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Pursues') ? [] : ['className' => PursuesTable::class];
        $this->Pursues = TableRegistry::get('Pursues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pursues);

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
