<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('back.pages.index',compact('pages'));
    }
}
