<?php
use Migrations\AbstractSeed;

/**
 * States seed.
 */
class CategoriesListsSeed extends AbstractSeed
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
                'category_id' => '3',
                'list_id'=> '1',

            ],
        ];

        $table = $this->table('categories_lists');
        $table->insert($data)->save();
    }
}
