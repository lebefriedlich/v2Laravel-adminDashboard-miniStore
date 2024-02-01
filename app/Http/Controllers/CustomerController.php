<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CustomerController extends Controller
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
        $url = "http://localhost/admin-miniStore-api/public/customers";
        $response = $client->request('GET', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        return view('customers.index', ['data' => $data]);
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
        $url = "http://localhost/admin-miniStore-api/public/customers/addUser";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/x-www-form-urlencoded'],
            'body' => json_encode($params)    
        ]);

        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        
        if ($contentArray['status'] == 'error'){
            $error = $contentArray['message'];
            return redirect()->to('customers')->withErrors($error)->withInput();
        } else {
            return redirect()->to('customers')->with('succes', $contentArray['message']);
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
        $url = "http://localhost/admin-miniStore-api/public/customers/edit/$id";
        $response = $client->request('PUT', $url, [
            'headers' => ['Content-type' => 'application/x-www-form-urlencoded'],
            'form_params' => $params,
        ]);
        
        $content =  $response->getBody()->getContents();
        
        var_dump($content);
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] == 'error'){
            $error = $contentArray['message'];
            return redirect()->to('customers')->withErrors($error)->withInput();
        } else {
            return redirect()->to('customers')->with('succes', $contentArray['message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = new Client();
        $url = "http://localhost/admin-miniStore-api/public/customers/delete/$id";
        $response = $client->request('DELETE', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] == 'error'){
            $error = $contentArray['message'];
            return redirect()->to('customers')->withErrors($error)->withInput();
        } else {
            return redirect()->to('customers')->with('succes', $contentArray['message']);
        }
    }
}
