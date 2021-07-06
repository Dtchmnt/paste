<?php

namespace App\Http\Controllers;

use App\Models\Paste;
use Illuminate\Http\Request;

class PasteController extends Controller
{
    public function index()
    {
        $list_post = Paste::orderBy('created_at', 'desc')->paginate(10);
        return view('paste.index',[
            'pastes' => $list_post
        ]);
    }

    public function list()
    {

    }

}
