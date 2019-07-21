<?php
use Migrations\AbstractSeed;

/**
 * States seed.
 */
class CategoriesSeed extends AbstractSeed
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
                'id' => '1',
                'parent_id' => '0',
                'lft'=>'1',
                'rght' => '4',
                'title'=> 'National archives‎',
                'type'=>'1',
                'status' => '1',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
            [
                'id' => '2',
                'parent_id' => '0',
                'lft'=>'5',
                'rght' => '8',
                'title'=> 'Patent offices‎',
                'type'=>'1',
                'status' => '1',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
            [
                'id' => '3',
                'parent_id' => '0',
                'lft'=>'9',
                'rght' => '10',
                'title'=> 'Forest service',
                'type'=>'2',
                'status' => '1',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
            [
                'id' => '4',
                'parent_id' => '1',
                'lft'=>'2',
                'rght' => '3',
                'title'=> 'Testing Title',
                'type'=>'2',
                'status' => '1',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
            [
                'id' => '5',
                'parent_id' => '3',
                'lft'=>'6',
                'rght' => '7',
                'title'=> 'new-youtube',
                'type'=>'1',
                'status' => '1',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],

        ];

        $table = $this->table('categories');
        $table->insert($data)->save();
    }
}
