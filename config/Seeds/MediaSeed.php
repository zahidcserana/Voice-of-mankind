<?php
use Migrations\AbstractSeed;

class MediaSeed extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'story_id' => '1',
                'type'=>'1',
                'mime_type' => 'image/jpeg',
                'file_name'=>'1518336627_3436393_IMG_20160327_160535.jpg',
                'is_featured'=>'0',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],

            [
                'id' => '2',
                'story_id' => '2',
                'type'=>'1',
                'mime_type' => 'image/jpeg',
                'file_name'=>'1524029904_b90nqfgj_sports-1.jpg',
                'is_featured'=>'0',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],

            [
                'id' => '3',
                'story_id' => '3',
                'type'=>'1',
                'mime_type' => 'image/jpeg',
                'file_name'=>'1524030016_mz4l88x0_IT2009_50.jpg',
                'is_featured'=>'0',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
            [
                'id' => '4',
                'story_id' => '4',
                'type'=>'1',
                'mime_type' => 'image/jpeg',
                'file_name'=>'1524031392_ota8s97p_qaz.jpg',
                'is_featured'=>'0',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
            [
                'id' => '5',
                'story_id' => '5',
                'type'=>'1',
                'mime_type' => 'image/jpeg',
                'file_name'=>'1524031621_x2hwf1to_GREENLAND_TriArcticNatParkExped_600x450.jpg',
                'is_featured'=>'0',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
            [
                'id' => '6',
                'story_id' => '6',
                'type'=>'1',
                'mime_type' => 'image/jpeg',
                'file_name'=>'1524031781_79qgblnc_images(1).jpg',
                'is_featured'=>'0',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
            [
                'id' => '7',
                'story_id' => '7',
                'type'=>'1',
                'mime_type' => 'image/jpeg',
                'file_name'=>'1524031860_1e69cvm0_images(2).jpg',
                'is_featured'=>'0',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
            [
                'id' => '8',
                'story_id' => '8',
                'type'=>'1',
                'mime_type' => 'image/jpeg',
                'file_name'=>'1524031971_oj7fdeng_abcmoney.jpg',
                'is_featured'=>'0',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
            [
                'id' => '9',
                'story_id' => '9',
                'type'=>'1',
                'mime_type' => 'image/jpeg',
                'file_name'=>'1524032034_5jcbuzix_Lebanon_High_School_Kentucky.jpg',
                'is_featured'=>'0',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],
            [
                'id' => '10',
                'story_id' => '10',
                'type'=>'1',
                'mime_type' => 'image/jpeg',
                'file_name'=>'1524032154_8wh7mzv4_logo_safe-sports-school.jpg',
                'is_featured'=>'0',
                'created' => '2018-04-04 09:43:29',
                'modified' => '2018-04-04 09:43:29',
            ],

        ];
        $table = $this->table('media');
        $table->insert($data)->save();
    }
}
