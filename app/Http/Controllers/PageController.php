<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PageController extends Controller

{
    public function index()
    {
        try {
            $response = Http::get(env('API_URL'));
            $products = $response->json()['products'];
            return view('index', compact('products'));
        } catch (\Exception $e) {
            // Handle the exception here
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $response = Http::get(env('API_URL'));
            $products = $response->json()['products'];
            $product = null;
            foreach ($products as $p) {
                if ($p['id'] == $id) {
                    $product = $p;
                    break;
                }
            }
            return view('show', compact('product'));
        } catch (\Exception $e) {
            // Handle the exception here
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function paginate()
    {
        try {
            $response = Http::get(env('API_URL'));
            $products = $response->json()['products'];
            $perPage = 3; // Number of products per page
            $currentPage = request()->query('page', 1); // Get the current page from the query string, default to 1 if not provided
            $total = count($products);
            $lastPage = ceil($total / $perPage); // Calculate the last page
            $offset = ($currentPage - 1) * $perPage; // Calculate the offset for pagination
            $paginatedProducts = array_slice($products, $offset, $perPage); // Get the products for the current page
            return view('paginate', compact('paginatedProducts', 'currentPage', 'lastPage'));
        } catch (\Exception $e) {
            // Handle the exception here
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
