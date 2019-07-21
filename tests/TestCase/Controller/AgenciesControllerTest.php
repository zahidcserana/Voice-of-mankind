<?php
namespace App\Test\TestCase\Controller;

use App\Controller\AgenciesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\AgenciesController Test Case
 */
class AgenciesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.agencies',
        'app.users',
        'app.states',
        'app.referrals',
        'app.stories',
        'app.comments',
        'app.media',
        'app.ratings',
        'app.categories',
        'app.lists',
        'app.categories_lists',
        'app.categories_stories',
        'app.referrals_stories'
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
