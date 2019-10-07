<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;

class EventController extends Controller
{
    public function index()
    {
        return view('event.event');
    }
}
