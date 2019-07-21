<?php
use Migrations\AbstractSeed;

/**
 * States seed.
 */
class ProfessionsSeed extends AbstractSeed
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
                'title'=> 'Lawer',
                'profession_code'=>'LA123',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],

            [
                'id' => '2',
                'title'=> 'Doctor',
                'profession_code'=>'DO123',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],

            [
                'id' => '3',
                'title'=> 'Businessman',
                'profession_code'=>'BU123',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],

            [
                'id' => '4',
                'title'=> 'Teacher',
                'profession_code'=>'TE123',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],




        ];

        $table = $this->table('professions');
        $table->insert($data)->save();
    }
}
