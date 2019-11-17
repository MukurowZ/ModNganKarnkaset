<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductServiceController extends Controller
{
    public function index(){ return view('product_service.product');}
    public function show($id){ return view('product_service.view-product', compact('id'));}
}
