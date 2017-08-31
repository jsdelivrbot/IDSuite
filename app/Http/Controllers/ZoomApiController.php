<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZoomApiController extends Controller
{
    /*The API Key, Secret, & URL will be used in every function.*/
    private $api_key = 'HFHFZLEtQ9eL3unBGGmgsw';
    private $api_secret = 'qUQAToA4TJBQJuXSjtrqQj1IY083EgPX6zOW';
    private $api_url = 'https://api.zoom.us/v1/';

    /*Function to send HTTP POST Requests*/
    /*Used by every function below to make HTTP POST call*/
    function sendRequest($calledFunction, $data){
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
        curl_close($ch);

        /*Will print back the response from the call*/
        /*Used for troubleshooting/debugging		*/
        if(!$response){
            return false;
        }
        /*Return the data in JSON format*/
        return json_decode($response);
    }

    function createAUser($user_email, $user_type){
        $createAUserArray = array(
            'email' => $user_email,
            'type'  => $user_type
        );
        return $this->sendRequest('user/create', $createAUserArray);
    }

    function autoCreateAUser($user_email, $user_type, $user_password){
        $autoCreateAUserArray = array(
            'email'     => $user_email,
            'type'      => $user_type,
            'password'  => $user_password
        );
        return $this->sendRequest('user/autocreate', $autoCreateAUserArray);
    }

    function custCreateAUser($user_email, $user_type){
        $custCreateAUserArray = array(
            'email' => $user_email,
            'type'  => $user_type
        );
        return $this->sendRequest('user/custcreate', $custCreateAUserArray);
    }

    function deleteAUser($user_id, $page_size = 50, $page_number = 1){
        $deleteAUserArray = array(
            'id'            => $user_id,
            'page_size'     => $page_size,
            'page_number'   => $page_number
        );
        return $this->sendRequest('user/delete', $deleteAUserArray);
    }

    function listUsers($page_size = 50, $page_number = 1){
        $listUsersArray = array(
            'page_size'     => $page_size,
            'page_number'   => $page_number
        );
        return $this->sendRequest('user/list', $listUsersArray);
    }

    function listPendingUsers($page_size = 50, $page_number = 1){
        $listPendingUsersArray = array(
            'page_size'     => $page_size,
            'page_number'   => $page_number
        );
        return $this->sendRequest('user/pending', $listPendingUsersArray);
    }

    function getUserInfo($user_id){
        $getUserInfoArray = array(
            'id' => $user_id
        );
        return $this->sendRequest('user/get',$getUserInfoArray);
    }

    function getUserInfoByEmail($user_email, $user_login_type){
        $getUserInfoByEmailArray = array(
            'email'         => $user_email,
            'login_type'    => $user_login_type
        );
        return $this->sendRequest('user/getbyemail',$getUserInfoByEmailArray);
    }

    function updateUserInfo($user_id){
        $updateUserInfoArray = array(
            'id' => $user_id
        );
        return $this->sendRequest('user/update',$updateUserInfoArray);
    }

    function updateUserPassword($user_id, $user_new_password){
        $updateUserPasswordArray = array(
            'id'        => $user_id,
            'password'  => $user_new_password
        );
        return $this->sendRequest('user/updatepassword', $updateUserPasswordArray);
    }

    function setUserAssistant($user_id, $user_email, $assistant_email){
        $setUserAssistantArray = array(
            'id'                => $user_id,
            'host_email'        => $user_email,
            'assistant_email'   => $assistant_email
        );
        return $this->sendRequest('user/assistant/set', $setUserAssistantArray);
    }

    function deleteUserAssistant($user_id, $user_email, $assistant_email){
        $deleteUserAssistantArray = array(
            'id'                => $user_id,
            'host_email'        => $user_email,
            'assistant_email'   => $assistant_email
        );
        return $this->sendRequest('user/assistant/delete',$deleteUserAssistantArray);
    }

    function revokeSSOToken($user_id, $user_email){
        $revokeSSOTokenArray = array(
            'id'    => $user_id,
            'email' => $user_email
        );
        return $this->sendRequest('user/revoketoken', $revokeSSOTokenArray);
    }

    function deleteUserPermanently($user_id, $user_email){
        $deleteUserPermanentlyArray = array(
            'id'    => $user_id,
            'email' => $user_email
        );
        return $this->sendRequest('user/permanentdelete', $deleteUserPermanentlyArray);
    }


    function createAMeeting($user_id, $meeting_topic, $meeting_type){
        $createAMeetingArray = array(
            'host_id'   => $user_id,
            'topic'     => $meeting_topic,
            'type'      => $meeting_type
        );
        return $this->sendRequest('meeting/create', $createAMeetingArray);
    }

    function deleteAMeeting($meeting_id, $user_id){
        $deleteAMeetingArray = array(
            'id'        => $meeting_id,
            'host_id'   => $user_id
        );
        return $this->sendRequest('meeting/delete', $deleteAMeetingArray);
    }

    function listMeetings($user_id, $page_size = 50, $page_number = 1){
        $listMeetingsArray = array(
            'host_id'       => $user_id,
            'page_size'     => $page_size,
            'page_number'   => $page_number
        );
        return $this->sendRequest('meeting/list',$listMeetingsArray);
    }

    function getMeetingInfo($meeting_id, $user_id){
        $getMeetingInfoArray = array(
            'id'        => $meeting_id,
            'host_id'   => $user_id
        );
        return $this->sendRequest('meeting/get', $getMeetingInfoArray);
    }

    function endAMeeting($meeting_id, $user_id){
        $endAMeetingArray = array(
            'id'        => $meeting_id,
            'host_id'   => $user_id
        );
        return $this->sendRequest('meeting/end', $endAMeetingArray);
    }

    function getDailyReport($month, $year){
        $getDailyReportArray = array(
            'month' => $month,
            'year'  => $year
        );
        return $this->sendRequest('report/getdailyreport', $getDailyReportArray);
    }

    function getAccountReport($from, $to){
        $getAccountReportArray = array(
            'from'  => $from,
            'to'    => $to
        );
        return $this->sendRequest('report/getaccountreport', $getAccountReportArray);
    }

    function getUserReport($user_id, $from, $to){
        $getUserReportArray = array(
            'user_id'   => $user_id,
            'from'      => $from,
            'to'        => $to
        );
        return $this->sendRequest('report/getuserreport', $getUserReportArray);
    }

    function createAWebinar($user_id, $topic){
        $createAWebinarArray = array(
            'host_id'   => $user_id,
            'topic'     => $topic
        );
        return $this->sendRequest('webinar/create',$createAWebinarArray);
    }

    function deleteAWebinar($webinar_id, $user_id){
        $deleteAWebinarArray = array(
            'id'        => $webinar_id,
            'host_id'   => $user_id
        );
        return $this->sendRequest('webinar/delete',$deleteAWebinarArray);
    }

    function listWebinars($user_id, $page_size = 50, $page_number = 1){
        $listWebinarsArray = array(
            'host_id'       => $user_id,
            'page_size'     => $page_size,
            'page_number'   => $page_number
        );
        return $this->sendRequest('webinar/list',$listWebinarsArray);
    }

    function getWebinarInfo($webinar_id, $user_id){
        $getWebinarInfoArray = array(
            'id'        => $webinar_id,
            'host_id'   => $user_id
        );
        return $this->sendRequest('webinar/get',$getWebinarInfoArray);
    }

    function updateWebinarInfo($webinar_id, $user_id){
        $updateWebinarInfoArray = array(
            'id'        => $webinar_id,
            'host_id'   => $user_id
        );
        return $this->sendRequest('webinar/update',$updateWebinarInfoArray);
    }
    
    function endAWebinar($webinar_id, $user_id){
        $endAWebinarArray = array(
            'id'        => $webinar_id,
            'host_id'   => $user_id
        );
        return $this->sendRequest('webinar/end',$endAWebinarArray);
    }

}
