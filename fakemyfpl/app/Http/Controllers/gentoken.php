<?php
namespace App\Http\Controllers;

use Exception;
use Google_Client;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
class GenToken {
    public function getGoogleAccessToken(){

        $credentialsFilePath = 'C:\Users\Admins\Downloads\firebase.json'; //replace this with your actual path and file name
        $client = new Google_Client();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();
        return $token['access_token'];
   }
   public function execute($keyInHere, $dataPost = [])
    {
        $url = "https://fcm.googleapis.com/v1/projects/myfplfake/messages:send";
        $result = false;
        try {
            $client = new Client();
            $result = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $keyInHere
                ],
                'json' => array($dataPost),
            ]);

            $result = $result->getStatusCode() == Response::HTTP_OK;
            
        } catch (Exception $e) {
            Log::debug($e);
        };

        return $result;
    }
}