<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use DB;

class ContactController extends Controller
{
    public function index()
    {
        return view("welcome");
    }

    public function store(ContactRequest $request)
    {
        dd($request->all());
    }
}
