<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;

class AdminController extends Controller
{
    public function contact(){ return view('contact.contact_report');}

    // Event Section
    public function event(){ return view('event.admin-event');}
    public function editEvent($id){ return view('event.edit-event', compact('id'));}
    public function createEvent(){ return view('event.create-event');}

    public function activity(){ return view('event.admin-event');}

    public function product(){ return view('');}
}
