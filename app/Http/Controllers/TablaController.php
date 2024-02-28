<?php

namespace App\Http\Controllers;

use Request;
use GuzzleHttp\Client;

class TablaController extends Controller
{
    function index(){
        try{
            $client = new Client(['verify' => false]);
            $request = $client->get('https://api.github.com/users');
            $response = json_decode($request->getBody()->getContents());
            return view('usersTable', ['users'=> $response]);
        } catch(RequestException $e){
            return null;
        }
    }

   function userDetails(){
    $username = Request::input('username');
    try{
        $client = new Client(['verify' => false]);
        $request = $client->get('https://api.github.com/users/'.$username);
        $response = json_decode($request->getBody()->getContents());
        return json_decode($response);
    } catch(RequestException $e){
        return $e->getMessage();
    }
   }
}
