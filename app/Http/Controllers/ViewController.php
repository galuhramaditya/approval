<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class ViewController extends Controller
{
    public function login()
    {
        return View::make("pages.login");
    }

    public function documents()
    {
        return View::make("pages.documents.index");
    }

    public function details()
    {
        return View::make("pages.details.index");
    }
}