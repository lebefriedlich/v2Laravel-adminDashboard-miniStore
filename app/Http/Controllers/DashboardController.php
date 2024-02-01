<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class DashboardController extends Controller
{
    public function index()
    {
        if(!session('status')){
            return redirect()->to('login')->withErrors('Please Log In First!')->withInput();
        }
        
        $client = new Client();
        $url = "http://localhost/admin-miniStore-api/public/";
        $response = $client->request('GET', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        return view('dashboard.index', ['data' => $data]);
    }
}
