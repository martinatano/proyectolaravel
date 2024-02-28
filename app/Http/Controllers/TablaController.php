<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    function eliminar($id, $username)
    {
        return view('userDetails', ['id' => $id, 'username' => $username]);
    }
}
