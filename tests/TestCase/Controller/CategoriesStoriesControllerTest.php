<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CategoriesStoriesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\CategoriesStoriesController Test Case
 */
class CategoriesStoriesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.categories_stories',
        'app.categories',
        'app.lists',
        'app.users',
        'app.categories_lists',
        'app.stories',
        'app.agencies',
        'app.states',
        'app.referrals',
        'app.referrals_stories',
        'app.comments',
        'app.media',
        'app.ratings'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}