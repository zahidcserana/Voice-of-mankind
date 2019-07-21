<?php
use Migrations\AbstractSeed;

/**
 * States seed.
 */
class CategoriesStoriesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'category_id' => '1',
                'story_id'=> '1',

            ],
            [
                'category_id' => '1',
                'story_id'=> '5',

            ],
            [
                'category_id' => '1',
                'story_id'=> '7',

            ],

            [
                'category_id' => '2',
                'story_id'=> '2',

            ],
            [
                'category_id' => '2',
                'story_id'=> '6',

            ],
            [
                'category_id' => '2',
                'story_id'=> '8',

            ],
            [
                'category_id' => '3',
                'story_id'=> '3',

            ],
            [
                'category_id' => '3',
                'story_id'=> '9',

            ],
            [
                'category_id' => '4',
                'story_id'=> '4',

            ],
            [
                'category_id' => '4',
                'story_id'=> '10',

            ],


        ];

        $table = $this->table('categories_stories');
        $table->insert($data)->save();
    }
}
