<?php
use Migrations\AbstractSeed;

/**
 * States seed.
 */
class ReferralsStoriesSeed extends AbstractSeed
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
                'referral_id' => '1',
                'story_id'=> '1',

            ],
            [
                'referral_id' => '1',
                'story_id'=> '5',

            ],
            [
                'referral_id' => '1',
                'story_id'=> '7',

            ],

            [
                'referral_id' => '2',
                'story_id'=> '2',

            ],
            [
                'referral_id' => '2',
                'story_id'=> '6',

            ],
            [
                'referral_id' => '2',
                'story_id'=> '8',

            ],
            [
                'referral_id' => '3',
                'story_id'=> '3',

            ],
            [
                'referral_id' => '3',
                'story_id'=> '9',

            ],
            [
                'referral_id' => '4',
                'story_id'=> '4',

            ],
            [
                'referral_id' => '4',
                'story_id'=> '10',

            ],


        ];

        $table = $this->table('referrals_stories');
        $table->insert($data)->save();
    }
}
