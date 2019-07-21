<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CategoriesStoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CategoriesStoriesTable Test Case
 */
class CategoriesStoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CategoriesStoriesTable
     */
    public $CategoriesStories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.categories_stories',
        'app.categories',
        'app.lists',
        'app.categories_lists',
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
        $config = TableRegistry::exists('CategoriesStories') ? [] : ['className' => CategoriesStoriesTable::class];
        $this->CategoriesStories = TableRegistry::get('CategoriesStories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CategoriesStories);

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
