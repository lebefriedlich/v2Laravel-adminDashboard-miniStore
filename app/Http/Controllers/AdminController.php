<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!session('status')){
            return redirect()->to('login')->withErrors('Please Log In First!')->withInput();
        }
        
        $client = new Client();
        $url = "http://localhost/admin-miniStore-api/public/admins";
        $response = $client->request('GET', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        return view('admins.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name_user = $request->name_user;
        $email = $request->email;
        $pass = $request->pass;
        $confirmPass = $request->confirmPass;

        $params = [
            'name_user' => $name_user,
            'email' => $email,
            'pass' => $pass,
            'confirmPass'=> $confirmPass 
        ];

        $client = new Client();
        $url = "http://localhost/admin-miniStore-api/public/admins/addAdmin";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/x-www-form-urlencoded'],
            'body' => json_encode($params)    
        ]);

        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        
        if ($contentArray['status'] == 'error'){
            $error = $contentArray['message'];
            return redirect()->to('admins')->withErrors($error)->withInput();
        } else {
            return redirect()->to('admins')->with('succes', $contentArray['message']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $name_user = $request->name_user;
        $email = $request->email;
        $pass = $request->pass;
        $passOld = $request->passOld;

        $params = [
            'name_user' => $name_user,
            'email' => $email,
            'pass' => $pass,
            'passOld'=> $passOld 
        ];

        $client = new Client();
        $url = "http://localhost/admin-miniStore-api/public/admins/edit/$id";
        $response = $client->request('PUT', $url, [
            'headers' => ['Content-type' => 'application/x-www-form-urlencoded'],
            'form_params' => $params,
        ]);
        
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['status'] == 'error'){
            $error = $contentArray['message'];
            return redirect()->to('admins')->withErrors($error)->withInput();
        } else {
            return redirect()->to('admins')->with('succes', $contentArray['message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = new Client();
        $url = "http://localhost/admin-miniStore-api/public/admins/delete/$id";
        $response = $client->request('DELETE', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        
        if ($contentArray['status'] == 'error'){
            $error = $contentArray['message'];
            return redirect()->to('admins')->withErrors($error)->withInput();
        } else {
            return redirect()->to('admins')->with('succes', $contentArray['message']);
        }
    }
}
