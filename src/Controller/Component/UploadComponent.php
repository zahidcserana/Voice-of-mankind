<?php
/**
 * Created by PhpStorm.
 * User: Mushfique
 * Date: 2/7/2018
 * Time: 12:12 PM
 */

namespace App\Controller\Component;


use Cake\Controller\Component;

class UploadComponent extends Component {

    var $allowdMimeTypes = array(
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'image/jpeg',
        'text/plain',
        'image/png',
        'image/gif',
        'audio/mpeg',
        'audio/ogg',
        'audio/*',
        'video/mp4',
        'application/octet-stream',
        'application/pdf',
        'application/vnd.ms-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'application/vnd.ms-excel'
    );

    /**
     * @desc Upload a File into respective directory, return path, renamed name and some other values
     *
     * @param $fileData
     * @param $user
     * @return string
     */
    public function uploadFile($fileData, $user, $createThumb = false, $adPath = false){
        $response['success'] = true;
        if (!empty($fileData['name'])) {
            if(in_array($fileData['type'], $this->allowdMimeTypes)){
                if(isset($adPath) && empty($user)){
                    $directoryPath = $adPath;
                } else{
                    $directoryPath = WWW_ROOT . 'img' . DS . 'stories'.DS. $user['id'];
                }                
                if (!is_dir($directoryPath)) {
                    mkdir($directoryPath);
                }
                $directoryPath .= DS;
                $renamedName = time() . '_' . $this->randomnum(7). '_' . str_replace(" ", "", $fileData['name']);
                if(move_uploaded_file($fileData['tmp_name'], $directoryPath . $renamedName)){
                    $response['file_name'] = $renamedName;
                    $response['mime_type'] = $fileData['type'];
                }else{
                    $response['success'] = false;
                    $response['error_message'] = 'File upload failed! Please try again.';
                }
            }else{
                $response['success'] = false;
                $response['error_message'] = 'Upload failed! Invalid file type';
            }
        }else{
            $response['success'] = false;
            $response['error_message'] = 'Upload failed! File is corrupted.';
        }
        return $response;
    }

    function randomnum($length) {
        $randstr = "";
        srand((double) microtime() * 1000000);
        //our array add all letters and numbers if you wish
        $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        for ($rand = 0; $rand <= $length; $rand++) {
            $random = rand(0, count($chars) - 1);
            $randstr .= $chars[$random];
        }
        return $randstr;
    }
}