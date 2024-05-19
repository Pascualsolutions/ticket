<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;


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
            // Ensure API_URL is defined
            $apiUrl = env('API_URL');
            if (!$apiUrl) {
                return response()->json(['error' => 'API_URL is not defined in the environment variables.'], 500);
            }

            // Fetch the data from the API
            $response = Http::get($apiUrl);

            // Check if the response is successful
            if ($response->failed()) {
                return response()->json(['error' => 'Failed to fetch data from the API.'], $response->status());
            }

            // Decode the response and validate the structure
            $data = $response->json();
            if (!isset($data['products'])) {
                return response()->json(['error' => 'Invalid response structure.'], 500);
            }

            $products = $data['products'];
            $perPage = 5; // Number of products per page
            $currentPage = request()->query('page', 1); // Get the current page from the query string, default to 1 if not provided
            $total = count($products);
            $lastPage = ceil($total / $perPage); // Calculate the last page
            $offset = ($currentPage - 1) * $perPage; // Calculate the offset for pagination

            // Get the products for the current page
            $paginatedProducts = array_slice($products, $offset, $perPage);

            // Return the view with paginated products
            return view('paginate', compact('paginatedProducts', 'currentPage', 'lastPage'));
        } catch (\Exception $e) {
            // Handle any unexpected exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
