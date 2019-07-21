<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ListsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ListsController Test Case
 */
class ListsControllerTest extends IntegrationTestCase
{

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
        'app.agencies',
        'app.states',
        'app.referrals',
        'app.referrals_stories',
        'app.comments',
        'app.media',
        'app.ratings',
        'app.categories_stories'
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
