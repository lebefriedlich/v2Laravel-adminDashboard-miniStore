<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $client = new Client();
        $url = "http://localhost/admin-miniStore-api/public/login";
        $response = $client->request('GET', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        return view('login.index', ['data' => $data]);
    }

    public function authentication(Request $request)
    {
        $email = $request->email;
        $pass = $request->pass;

        $params = [
            'email' => $email,
            'pass' => $pass,
        ];

        $client = new Client();
        $url = "http://localhost/admin-miniStore-api/public/login/aunthenticate";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/x-www-form-urlencoded'],
            'body' => json_encode($params),
        ]);

        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['status'] == 'success') {
            session(['status' => 'success']);
            return redirect()->to('dashboard')->with('data', $contentArray['data']['name_user']);
        } else {
            $error = $contentArray['message'];
            return redirect()->to('login')->withErrors($error)->withInput();
        }
    }

    public function logout()
    {
        Auth::logout(); 
        session()->invalidate(); 
        session()->regenerateToken(); 
    
        return redirect()->to('login'); 
    }
}
