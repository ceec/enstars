<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Goutte\Client;

class ToolController extends Controller {


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Chase down HE links for offical images
     *
     * 
     */
    public function linkFinder() {

        $client = new Client();


          for ($i=1100;$i<1120;$i++) {
            //$url = 'https://support.ensemble-stars.jp/music/cat_2/'.$i;
            $url = 'https://support.ensemble-stars.jp/basic/cat_2/'.$i;
            echo '<a href="'.$url.'">'.$url.'</a><br>';
            $crawler = $client->request('GET', $url);
            $response = $client->getInternalResponse();
            // echo $response->getStatus();
            foreach ( $response->getHeaders()['Link'] as $link) {
              echo htmlentities($link).'<br>';
            }
            echo '<hr>';
          }


          // Testing one
          // $url = 'https://support.ensemble-stars.jp/music/cat_2/71';
          // $crawler = $client->request('GET', $url);
          // $response = $client->getInternalResponse();  

          // foreach ( $response->getHeaders()['Link'] as $link) {
          //   echo htmlentities($link).'<br>';
          // }

    }



}
