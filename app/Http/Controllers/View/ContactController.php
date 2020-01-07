<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;

class ContactController extends Controller
{
    public function contact(){ return view('contact.main_contact');}
    public function form(){ return view('contact.contact_form');}
    public function partner(){ return view('contact.partner');}
}
