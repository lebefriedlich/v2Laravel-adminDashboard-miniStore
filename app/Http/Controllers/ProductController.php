<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $url = "http://localhost/admin-miniStore-api/public/products";
        $response = $client->request('GET', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        return view('products.index', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name_product = $request->name_product;
        $description = $request->description;
        $image = $request->file('image');
        $price = $request->price;
        $qty = $request->qty;
        $category = $request->category;
        $brand = $request->brand;

        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images/product'), $imageName);

        $params = [
            'name_product' => $name_product,
            'description' => $description,
            'image' => $imageName,
            'price' => $price,
            'qty' => $qty,
            'category' => $category,
            'brand' => $brand,
        ];

        $client = new Client();
        $url = "http://localhost/admin-miniStore-api/public/products/addProduct";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/x-www-form-urlencoded'],
            'body' => json_encode($params),
        ]);

        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['status'] == 'error') {
            $error = $contentArray['message'];
            return redirect()->to('products')->withErrors($error)->withInput();
        } else {
            return redirect()->to('products')->with('succes', $contentArray['message']);
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
        $name_product = $request->name_product;
        $description = $request->description;
        $image = $request->file('image');
        $price = $request->price;
        $qty = $request->qty;
        $category = $request->category;
        $brand = $request->brand;

        $params = [
            'name_product' => $name_product,
            'description' => $description,
            'price' => $price,
            'qty' => $qty,
            'category' => $category,
            'brand' => $brand,
        ];

        if (!empty($image)) {
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/product'), $imageName);

            $params['image'] = $imageName;
        }

        $client = new Client();
        $url = "http://localhost/admin-miniStore-api/public/products/editProduct/$id";
        $response = $client->request('PUT', $url, [
            'headers' => ['Content-type' => 'application/x-www-form-urlencoded'],
            'form_params' => $params,
        ]);

        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['status'] == 'error') {
            $error = $contentArray['message'];
            return redirect()->to('products')->withErrors($error)->withInput();
        } else {
            if (!empty($image)) {
                $deletedFileName = $contentArray['deletedFileName'];

                $filePath = public_path('images/product/') . $deletedFileName;

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            return redirect()->to('products')->with('succes', $contentArray['message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = new Client();
        $url = "http://localhost/admin-miniStore-api/public/products/deleteProduct/$id";
        $response = $client->request('DELETE', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['status'] == 'error') {
            $error = $contentArray['message'];
            return redirect()->to('products')->withErrors($error)->withInput();
        } else {
            $deletedFileName = $contentArray['deletedFileName'];

            $filePath = public_path('images/product/') . $deletedFileName;

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            return redirect()->to('products')->with('succes', $contentArray['message']);
        }
    }
}
