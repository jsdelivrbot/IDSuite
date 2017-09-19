<?php

namespace App\Http\Controllers;

use App\DynamicEnum;
use App\DynamicEnumValue;
use App\Enums\EnumDataSourceType;
use App\User;

class ZoomApiController extends Controller
{

    private $api_key, $api_url, $api_secret;

    public function __construct()  {
        $this->api_key = env("ZOOM_KEY");
        $this->api_url = env("ZOOM_URL");
        $this->api_secret = env("ZOOM_SECRET");

        return $this;
    }

    public $reference_key = 'zoom';

    public $dynamic_enum = 'reference_key';

    public function getDynamic_enum(){
        return DynamicEnum::getByName($this->dynamic_enum);
    }

    /*Function to send HTTP POST Requests*/
    /*Used by every function below to make HTTP POST call*/
    public function sendRequest($calledFunction, $data){

        /*Creates the endpoint URL*/
        $request_url = $this->api_url.$calledFunction;

        /*Adds the Key, Secret, & Datatype to the passed array*/
        $data['api_key'] = $this->api_key;
        $data['api_secret'] = $this->api_secret;
        $data['data_type'] = 'JSON';

        $postFields = http_build_query($data);
        /*Check to see queried fields*/
        /*Used for troubleshooting/debugging*/

        /*Preparing Query...*/
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);


        /*Check for any errors*/
        $errorMessage = curl_exec($ch);
//        dump($errorMessage);
        curl_close($ch);

        /*Will print back the response from the call*/
        /*Used for troubleshooting/debugging		*/
        if(!$response){
            return false;
        }
        /*Return the data in JSON format*/
        return json_decode($response);
    }

    public function createAUser($user_email, $user_type){
        $createAUserArray = array(
            'email' => $user_email,
            'type'  => $user_type
        );
        return $this->sendRequest('user/create', $createAUserArray);
    }

    public function autoCreateAUser($user_email, $user_type, $user_password){
        $autoCreateAUserArray = array(
            'email'     => $user_email,
            'type'      => $user_type,
            'password'  => $user_password
        );
        return $this->sendRequest('user/autocreate', $autoCreateAUserArray);
    }

    public function custCreateAUser($user_email, $user_type){
        $custCreateAUserArray = array(
            'email' => $user_email,
            'type'  => $user_type
        );
        return $this->sendRequest('user/custcreate', $custCreateAUserArray);
    }

    public function deleteAUser($user_id, $page_size = 50, $page_number = 1){
        $deleteAUserArray = array(
            'id'            => $user_id,
            'page_size'     => $page_size,
            'page_number'   => $page_number
        );
        return $this->sendRequest('user/delete', $deleteAUserArray);
    }

    public function listUsers($page_size = 50, $page_number = 1){
        $listUsersArray = array(
            'page_size'     => $page_size,
            'page_number'   => $page_number
        );
        return $this->sendRequest('user/list', $listUsersArray);
    }

    public function listPendingUsers($page_size = 50, $page_number = 1){
        $listPendingUsersArray = array(
            'page_size'     => $page_size,
            'page_number'   => $page_number
        );
        return $this->sendRequest('user/pending', $listPendingUsersArray);
    }

    public function getUserInfo($user_id){
        $getUserInfoArray = array(
            'id' => $user_id
        );
        return $this->sendRequest('user/get',$getUserInfoArray);
    }

    public function getUserInfoByEmail($user_email, $user_login_type){
        $getUserInfoByEmailArray = array(
            'email'         => $user_email,
            'login_type'    => $user_login_type
        );
        return $this->sendRequest('user/getbyemail',$getUserInfoByEmailArray);
    }

    public function updateUserInfo($user_id){
        $updateUserInfoArray = array(
            'id' => $user_id
        );
        return $this->sendRequest('user/update',$updateUserInfoArray);
    }

    public function updateUserPassword($user_id, $user_new_password){
        $updateUserPasswordArray = array(
            'id'        => $user_id,
            'password'  => $user_new_password
        );
        return $this->sendRequest('user/updatepassword', $updateUserPasswordArray);
    }

    public function setUserAssistant($user_id, $user_email, $assistant_email){
        $setUserAssistantArray = array(
            'id'                => $user_id,
            'host_email'        => $user_email,
            'assistant_email'   => $assistant_email
        );
        return $this->sendRequest('user/assistant/set', $setUserAssistantArray);
    }

    public function deleteUserAssistant($user_id, $user_email, $assistant_email){
        $deleteUserAssistantArray = array(
            'id'                => $user_id,
            'host_email'        => $user_email,
            'assistant_email'   => $assistant_email
        );
        return $this->sendRequest('user/assistant/delete',$deleteUserAssistantArray);
    }

    public function revokeSSOToken($user_id, $user_email){
        $revokeSSOTokenArray = array(
            'id'    => $user_id,
            'email' => $user_email
        );
        return $this->sendRequest('user/revoketoken', $revokeSSOTokenArray);
    }

    public function deleteUserPermanently($user_id, $user_email){
        $deleteUserPermanentlyArray = array(
            'id'    => $user_id,
            'email' => $user_email
        );
        return $this->sendRequest('user/permanentdelete', $deleteUserPermanentlyArray);
    }

    public function createAMeeting($user_id, $meeting_topic, $meeting_type){
        $createAMeetingArray = array(
            'host_id'   => $user_id,
            'topic'     => $meeting_topic,
            'type'      => $meeting_type
        );
        return $this->sendRequest('meeting/create', $createAMeetingArray);
    }

    public function deleteAMeeting($meeting_id, $user_id){
        $deleteAMeetingArray = array(
            'id'        => $meeting_id,
            'host_id'   => $user_id
        );
        return $this->sendRequest('meeting/delete', $deleteAMeetingArray);
    }

    public function listMeetings($user_id, $page_size = 50, $page_number = 1){
        $listMeetingsArray = array(
            'host_id'       => $user_id,
            'page_size'     => $page_size,
            'page_number'   => $page_number
        );
        return $this->sendRequest('meeting/list',$listMeetingsArray);
    }

    public function getMeetingInfo($meeting_id, $user_id){
        $getMeetingInfoArray = array(
            'id'        => $meeting_id,
            'host_id'   => $user_id
        );
        return $this->sendRequest('meeting/get', $getMeetingInfoArray);
    }

    public function endAMeeting($meeting_id, $user_id){
        $endAMeetingArray = array(
            'id'        => $meeting_id,
            'host_id'   => $user_id
        );
        return $this->sendRequest('meeting/end', $endAMeetingArray);
    }

    public function getDailyReport($month, $year){
        $getDailyReportArray = array(
            'month' => $month,
            'year'  => $year
        );
        return $this->sendRequest('report/getdailyreport', $getDailyReportArray);
    }

    public function getAccountReport($from, $to){
        $getAccountReportArray = array(
            'from'  => $from,
            'to'    => $to
        );
        return $this->sendRequest('report/getaccountreport', $getAccountReportArray);
    }

    public function getUserReport($user_id, $from, $to){
        $getUserReportArray = array(
            'user_id'   => $user_id,
            'from'      => $from,
            'to'        => $to
        );
        return $this->sendRequest('report/getuserreport', $getUserReportArray);
    }

    public function createAWebinar($user_id, $topic){
        $createAWebinarArray = array(
            'host_id'   => $user_id,
            'topic'     => $topic
        );
        return $this->sendRequest('webinar/create',$createAWebinarArray);
    }

    public function deleteAWebinar($webinar_id, $user_id){
        $deleteAWebinarArray = array(
            'id'        => $webinar_id,
            'host_id'   => $user_id
        );
        return $this->sendRequest('webinar/delete',$deleteAWebinarArray);
    }

    public function listWebinars($user_id, $page_size = 50, $page_number = 1){
        $listWebinarsArray = array(
            'host_id'       => $user_id,
            'page_size'     => $page_size,
            'page_number'   => $page_number
        );
        return $this->sendRequest('webinar/list',$listWebinarsArray);
    }

    public function getWebinarInfo($webinar_id, $user_id){
        $getWebinarInfoArray = array(
            'id'        => $webinar_id,
            'host_id'   => $user_id
        );
        return $this->sendRequest('webinar/get',$getWebinarInfoArray);
    }

    public function updateWebinarInfo($webinar_id, $user_id){
        $updateWebinarInfoArray = array(
            'id'        => $webinar_id,
            'host_id'   => $user_id
        );
        return $this->sendRequest('webinar/update',$updateWebinarInfoArray);
    }
    
    public function endAWebinar($webinar_id, $user_id){
        $endAWebinarArray = array(
            'id'        => $webinar_id,
            'host_id'   => $user_id
        );
        return $this->sendRequest('webinar/end',$endAWebinarArray);
    }



    public function mapUsers(){

        $obj = new \stdClass();

        $obj->missed_emails = array();

        $obj->missed = 0;

        $obj->updated_emails = array();

        $obj->updated = 0;

        $obj->created_emails = array();

        $obj->created = 0;

        $obj->unchanged_emails = array();

        $obj->unchanged = 0;

        foreach($this->listUsers(300)->users as $zuser){

            $user = User::getUserByEmail($zuser->email);

            if($user !== false && $user !== null){

                if($user->hasReference($this->reference_key)){

                    $currentvalue = $user->references()[$this->reference_key];

                    if($currentvalue !== $zuser->id){
                        // update reference key -> id //

                        $user->updateDev($this->reference_key, $zuser->id, $this->getDynamic_enum());

                        $obj->updated_emails[] = $zuser->email;

                        $obj->updated++;

                    } else {
                        // reference key is the same do not update and goto next user //

                        $obj->unchanged_emails[] = $zuser->email;

                        $obj->unchanged++;

                        continue;
                    }

                } else {
                    $dev = new DynamicEnumValue();

                    $dev->value = $zuser->id;

                    $de = DynamicEnum::getByName('reference_key');

                    $dev->value_type = EnumDataSourceType::getKeyByValue('zoom');

                    $dev->definition($de)->save($de);

                    $dev->save();

                    $user->references($dev);

                    $user->save();

                    $obj->created_emails[] = $zuser->email;

                    $obj->created++;
                }
            } else {

                $obj->missed_emails[] = $zuser->email;

                $obj->missed++;

                continue;
            }
        }

        return $obj;

    }


}
