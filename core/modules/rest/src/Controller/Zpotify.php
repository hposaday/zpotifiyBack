<?php
 
namespace Drupal\rest\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class Zpotify extends ControllerBase {

    private $tokenRequestUrl = "https://accounts.spotify.com/api/token";
    private $clientId = "96fba94d810447ac8b2b94e3c8ff2472";
    private $clientSecret = "d8b6261218c7408f80deac8dcc378e67";
    
    public function getBasicToken () {

        $encodedClientStrings = base64_encode($this->clientId.':'.$this->clientSecret);
        $headers = [
            'Authorization' => 'Basic '.$encodedClientStrings,
            'Content-Type' => 'application/x-www-form-urlencoded'    
        ];
        
        $client = new \GuzzleHttp\Client([
            'verify' => false,
            'headers' => $headers
            ]);

       

        $result = $client->request('POST', $this->tokenRequestUrl, [
            'form_params' => [
                'grant_type' => 'client_credentials'
            ]
        ]);

        $response = $result->getBody()->getContents();
        return $response;
    }

    public function requestHandler ($method, $url) {
        
        $tokenInfo = json_decode($this->getBasicToken(), true);
        
        $headers = [
            'Authorization' => ' Bearer '.$tokenInfo['access_token']
        ];

        $client = new \GuzzleHttp\Client([
            'verify' => false,
            'headers' => $headers
        ]);


        $result = $client->request($method, $url, $headers);
        
        $response = json_decode($result->getBody()->getContents());

        return $response;
    }
}