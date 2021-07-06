<?php

namespace App\Http\Controllers;

use App\Models\Paste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasteController extends Controller
{
    public function index()
    {
        $list_post = Paste::orderBy('created_at', 'desc')->paginate(10);
        return view('paste.index', [
            'pastes' => $list_post
        ]);
    }

    public function create(Request $request)
    {

        if ($request->change_anon) {
            $inputArray = array(
                'link' => Hash::make($request['link']),
                'name' => $request['name'],
                'title' => $request['title'],
                'text' => $request['text'],
                'privacy' => $request['privacy'],
                'expiration' => $request['expiration'],
                'user_id' => $request['user_id'] = null,
            );
        } else {
            $inputArray = array(
                'link' => Hash::make($request['link']),
                'name' => $request['name'],
                'title' => $request['title'],
                'text' => $request['text'],
                'privacy' => $request['privacy'],
                'expiration' => $request['expiration'],
                'user_id' => $request['user_id'] = Auth::check() ? Auth::user()->id : null
            );
        }
        Paste::create($inputArray);
        //сообщением о том какие мы молодыы
        return redirect()->back()->withSuccess('Пользователь успешно добавлен');

    }
}
