<?php
namespace App\Http\Controllers;

use Exception;
use Google_Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class GenToken {
    public function getGoogleAccessToken(){

        $credentialsFilePath = 'D:\GitHub\AndroidNetwork_Laravel_Server_2023\fakemyfpl\app\Http\Controllers\firebase.json'; //replace this with your actual path and file name
        $client = new Google_Client();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();
        return $token['access_token'];
   }
   public function execute($keyInHere)
    {
        $result = false;
        $url = "https://fcm.googleapis.com/v1/projects/myfplfake/messages:send";
        $method = 'POST';
        try {
            $client = new Client();
            $result = $client->request($method, $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $keyInHere,
                ],
                'json' => [
                    "message" => [
                        "topic" => "news",
                        "notification" => [
                            "title" => "Có tin mới",
                            "body" => "Hay click vào xem để kiểm tra thôngtin mới"
                        ]
                    ]
                ],
            ]);

            $result = $result->getStatusCode() == Response::HTTP_OK;
            
        } catch (Exception $e) {
            dd($e);
        };

        return $result;
    }
}