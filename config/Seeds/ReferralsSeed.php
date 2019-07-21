<?php
use Migrations\AbstractSeed;

/**
 * States seed.
 */
class ReferralsSeed extends AbstractSeed
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
                'user_id' => '3',
                'profession_id'=>'1',
                'adv_type'=> null,
                'name'=>'Adv Stan',
                'email'=>'advstan@advstan.com',
                'phone'=>'417565644',
                'state_id'=>'10',
                'county_id'=>'657',
                'city_id'=>'1745',
                'zip_code'=>'35801',
                'address'=>'gfdHeadquarters 1120 N Street Sacramento 916-654-5266gf, gfdssd',
                'is_active'=>'1',
                'status' => '1',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],

            [
                'id' => '2',
                'user_id' => '3',
                'profession_id'=>'1',
                'adv_type'=> null,
                'name'=>'Adv Stan',
                'email'=>'advstan@advstan.com',
                'phone'=>'417565644',
                'state_id'=>'10',
                'county_id'=>'657',
                'city_id'=>'1745',
                'zip_code'=>'35801',
                'address'=>'gfdHeadquarters 1120 N Street Sacramento 916-654-5266gf, gfdssd',
                'is_active'=>'1',
                'status' => '1',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
            [
                'id' => '3',
                'user_id' => '4',
                'profession_id'=>'3',
                'adv_type'=> null,
                'name'=>'Mark',
                'email'=>'mark@mark.com',
                'phone'=>'417565644',
                'state_id'=>'10',
                'county_id'=>'657',
                'city_id'=>'1745',
                'zip_code'=>'35801',
                'address'=>'Level 23, 242 Pitt Street',
                'is_active'=>'1',
                'status' => '1',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
            [
                'id' => '4',
                'user_id' => '4',
                'profession_id'=>'3',
                'adv_type'=> null,
                'name'=>'Symon',
                'email'=>'symon@symon.com',
                'phone'=>'417565644',
                'state_id'=>'10',
                'county_id'=>'657',
                'city_id'=>'1745',
                'zip_code'=>'35801',
                'address'=>'Level 23, 242 Pitt Street',
                'is_active'=>'1',
                'status' => '1',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],



        ];

        $table = $this->table('referrals');
        $table->insert($data)->save();
    }
}
