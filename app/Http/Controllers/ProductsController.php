<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hotel;
use App\Models\User;
use App\Models\Products;
use Inertia\Inertia;
use Redirect;
use Image;

class ProductsController extends Controller
{
    public function souvenirs($id)
    {
        $product = Products::with('images')->where('id', $id)->first();

        return Inertia::render('Dashboard/Show/Souvenirs', compact('product'));
    }
    public function activities($id)
    {
        $product = Products::with('images', 'activities')->where('id', $id)->first();
        $access_token = connect()['access_token'];
        return Inertia::render('Dashboard/Show/Activities', compact('product','access_token'));
    }
}
