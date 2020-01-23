<?php
 
namespace Drupal\rest\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

use \Drupal\rest\Controller\Zpotify;

class Albums extends ControllerBase {

    private $albumsUrl = 'https://api.spotify.com/v1/browse/new-releases';
    private $country = 'CO';
    
    public function getLatestReleases () {
        $zpotify = new Zpotify;
        
        $newAlbums = $zpotify->requestHandler('GET', $this->albumsUrl);

        $cleanAlbums = [];
        foreach ($newAlbums->albums->items as $albumKey => $albumData) {
            $albumName = $albumData->name;
            $image = $albumData->images[0];
            $artists = [];
            foreach ($albumData->artists as $artistKey => $artistData) {
                array_push($artists, [
                    'name' => $artistData->name,
                    'id' => $artistData->id
                ]);
            }
            $albumPushData = [
                'name' => $albumName,
                'image' => $image,
                'artists' => $artists
            ];

            array_push($cleanAlbums, $albumPushData);
        }
        
        $response =  new Response(json_encode([
            'status' => 'OK',
            'data' => $cleanAlbums, 
            'message' => 'NEW ALBUMS SUCCESFULLY RETRIEVED']));
            
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }

}