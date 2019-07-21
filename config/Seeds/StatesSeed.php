<?php
use Migrations\AbstractSeed;

/**
 * States seed.
 */
class StatesSeed extends AbstractSeed
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
                'id' => '2',
                'name' => 'DE',
                'latitude' => '0.00',
                'longitude' => '0.00',
                'population' => '0',
                'statename' => '',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
            [
                'id' => '3',
                'name' => 'MD',
                'latitude' => '0.00',
                'longitude' => '0.00',
                'population' => '0',
                'statename' => '',
                'created' => '2018-04-04 09:43:35',
                'modified' => '2018-04-04 09:43:35',
            ],
            [
                'id' => '4',
                'name' => 'DC',
                'latitude' => '0.00',
                'longitude' => '0.00',
                'population' => '0',
                'statename' => '',
                'created' => '2018-04-04 09:43:40',
                'modified' => '2018-04-04 09:43:40',
            ],
            [
                'id' => '5',
                'name' => 'VA',
                'latitude' => '0.00',
                'longitude' => '0.00',
                'population' => '0',
                'statename' => '',
                'created' => '2018-04-04 09:43:45',
                'modified' => '2018-04-04 09:43:45',
            ],
            [
                'id' => '6',
                'name' => 'WV',
                'latitude' => '0.00',
                'longitude' => '0.00',
                'population' => '0',
                'statename' => '',
                'created' => '2018-04-04 09:46:19',
                'modified' => '2018-04-04 09:46:19',
            ],
            [
                'id' => '7',
                'name' => 'NC',
                'latitude' => '0.00',
                'longitude' => '0.00',
                'population' => '0',
                'statename' => '',
                'created' => '2018-04-04 09:47:15',
                'modified' => '2018-04-04 09:47:15',
            ],
            [
                'id' => '8',
                'name' => 'SC',
                'latitude' => '0.00',
                'longitude' => '0.00',
                'population' => '0',
                'statename' => '',
                'created' => '2018-04-04 09:49:19',
                'modified' => '2018-04-04 09:49:19',
            ],
            [
                'id' => '9',
                'name' => 'GA',
                'latitude' => '0.00',
                'longitude' => '0.00',
                'population' => '0',
                'statename' => '',
                'created' => '2018-04-04 09:50:21',
                'modified' => '2018-04-04 09:50:21',
            ],
            [
                'id' => '10',
                'name' => 'FL',
                'latitude' => '0.00',
                'longitude' => '0.00',
                'population' => '0',
                'statename' => '',
                'created' => '2018-04-04 09:52:41',
                'modified' => '2018-04-04 09:52:41',
            ],
            [
                'id' => '11',
                'name' => 'TN',
                'latitude' => '0.00',
                'longitude' => '0.00',
                'population' => '0',
                'statename' => '',
                'created' => '2018-04-04 09:54:45',
                'modified' => '2018-04-04 09:54:45',
            ],
            [
                'id' => '12',
                'name' => 'KY',
                'latitude' => '0.00',
                'longitude' => '0.00',
                'population' => '0',
                'statename' => '',
                'created' => '2018-04-04 09:56:22',
                'modified' => '2018-04-04 09:56:22',
            ],
        ];

        $table = $this->table('states');
        $table->insert($data)->save();
    }
}
