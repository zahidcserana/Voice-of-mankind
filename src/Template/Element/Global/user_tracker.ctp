<?php
$userStateId = '';
$userCountyId = '';

$page = $this->request->params['controller'] . '_' . $this->request->params['action'];

use Cake\ORM\TableRegistry;

$user = TableRegistry::get('Users');
$zipCode = 0;
$userLoginStatus = 0;
$updateLocation = 0;
if (isset($session['Auth']['User']['id'])) {
    $userLoginStatus = 1;
    $checkLogin = $session['Auth']['User'];
    $userData = $user->find('all')->where(['id' => $checkLogin['id']])->first();
    $zipCode = empty($userData['zip_code']) == true ? 0 : $userData['zip_code'];
    $userStateId = $userData['state_id'];
    $userCountyId = $userData['county_id'];
    if(!isset($_COOKIE['userState']) && ($userStateId!='' && $userCountyId!='')) {
        setcookie("userState", $userStateId, time() + (86400 * 1), "/"); // 86400 = 1 day
        setcookie("userCounty", $userCountyId, time() + (86400 * 1), "/"); // 86400 = 1 day
    }

    if ($zipCode == 0 && $userStateId == 0) {
        $updateLocation = 1;
    }

}else{
    if(isset($_COOKIE['userState'])) {
        $userStateId = $_COOKIE['userState'];
        $userCountyId = $_COOKIE['userCounty'];
    }
}
?>

<input type="hidden" id="userStateId" value="<?php echo $userStateId; ?>">
<input type="hidden" id="userCountyId" value="<?php echo $userCountyId; ?>">
<input type="hidden" id="updateLocation" value="<?php echo $updateLocation; ?>">
<input type="hidden" id="userLoginStatus" value="<?php echo $userLoginStatus; ?>">
