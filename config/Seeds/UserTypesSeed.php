<?php
use Migrations\AbstractSeed;

/**
 * States seed.
 */
class UserTypesSeed extends AbstractSeed
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
                'title'=> 'Admin',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',

            ],
            [
              'id' => '2',
              'title'=> 'Member',
              'created' => '2018-04-04 09:43:29',
              'modified' => '2018-04-04 09:43:29',


            ],



        ];

        $table = $this->table('user_types');
        $table->insert($data)->save();
    }
}
