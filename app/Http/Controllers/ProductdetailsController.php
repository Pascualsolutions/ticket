<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ProductdetailsController extends Controller
{
    public function show($id)
    {
        return view('show', compact('id'));
    }
}
