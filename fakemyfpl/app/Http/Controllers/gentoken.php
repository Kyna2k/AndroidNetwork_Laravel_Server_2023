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

        $credentialsFilePath = 'C:\Users\huyno\Downloads\firebase.json'; //replace this with your actual path and file name
        $client = new Google_Client();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();
        return $token['access_token'];
   }
   public function execute($url = "https://fcm.googleapis.com/v1/projects/hstalkversion2/messages:send",$keyInHere, $dataPost = [], $method = 'POST')
    {
        $result = false;
        try {
            $client = new Client();
            $result = $client->request($method, $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'key=' . $keyInHere,
                ],
                'json' => $dataPost,
            ]);

            $result = $result->getStatusCode() == Response::HTTP_OK;
            
        } catch (Exception $e) {
            Log::debug($e);
        };

        return $result;
    }
}