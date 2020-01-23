<?php
 
namespace Drupal\rest\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

use \Drupal\rest\Controller\Zpotify;

class Artists extends ControllerBase {

    private $artistsUrl = 'https://api.spotify.com/v1/artists/';
    private $artistTopTracksUrl = 'https://api.spotify.com/v1/artists/{id}/top-tracks';
    private $country = 'CO';
    
    public function getArtist ($artistId) {

        $zpotify = new Zpotify;
       
        $artistData = $zpotify->requestHandler('GET', $this->artistsUrl.$artistId);

        $response = new Response(json_encode([
            'status' => 'OK',
            'data' => $artistData, 
            'message' => 'ARTIST DATA SUCCESFULLY RETRIEVED']));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function getArtistTopTracks ($artistId) {
        
        $zpotify = new Zpotify;

        $url = str_replace( '{id}', $artistId ,$this->artistTopTracksUrl);
      
        $artistTopTracks =  $zpotify->requestHandler('GET', $url.'?country='.$this->country);

        $cleanTopTracks = [];

        foreach ($artistTopTracks->tracks as $keyTrack => $trackData) {
            $trackPushData = [
                'trackName' => $trackData->name,
                'albumImage' => $trackData->album->images,
                'albumName' => $trackData->album->name
            ];
            array_push($cleanTopTracks, $trackPushData);
        }
        
        $response =  new Response(json_encode([
            'status' => 'OK',
            'data' => $cleanTopTracks, 
            'message' => 'TOP TRACKS SUCCESFULLY RETRIEVED']));
            
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }

}