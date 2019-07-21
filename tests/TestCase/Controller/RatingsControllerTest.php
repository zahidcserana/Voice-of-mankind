<?php
namespace App\Test\TestCase\Controller;

use App\Controller\RatingsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\RatingsController Test Case
 */
class RatingsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ratings',
        'app.users',
        'app.stories',
        'app.agencies',
        'app.states',
        'app.referrals',
        'app.referrals_stories',
        'app.comments',
        'app.media',
        'app.categories',
        'app.lists',
        'app.categories_lists',
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
