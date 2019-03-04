<?php
namespace App\TheApp\Libraries;

use App\Models\User;

trait SendNotification
{
    public  function send($data , $devices_id = null) 
    {

      if (is_array($devices_id)) {
          $tokens = array_values(array_unique($devices_id));
      } else {
          $tokens = array($devices_id);
      }

      $notification = array(
          'title'    => $data['title'],
          'body'     => $data['body'],
          'sound'    => 'default',
          'priority' => 'high',
      );

      $fields = array(
         'registration_ids' => $tokens,
         'notification'     => $notification
      );

      return $this->Push($fields);
    }

    public function Push($fields)
    {
      $url = 'https://fcm.googleapis.com/fcm/send';

      $headers = array(
          'Authorization:key=AAAAcpYhIzo:APA91bHjfa8srwD3zy6Q8aB6gtq_0ck4w9I9aLXZW6qcy22Gsy00YB1bjp_lg22rNdIZIOXkVwHA8QagN6uQKRNa8wlf5S7JOaHjbd0l5k5YvxB35jQ3H4ylqltrC77rgRKYKfrSiPdiwIv9lqJIXNjA5r_QHjdxhw',
          'Content-Type: application/json'
      );

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      // echo json_encode($fields);

      $result = curl_exec($ch);           
      echo curl_error($ch);
       
      if ($result === FALSE) {
         die('Curl failed: ' . curl_error($ch));
      }
      curl_close($ch);
      
      return $result;
    }

}