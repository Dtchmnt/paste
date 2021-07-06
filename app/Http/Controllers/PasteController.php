<?php

namespace App\Http\Controllers;

use App\Models\Paste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasteController extends Controller
{

    private function linkUrl()
    {
        $bytes = random_bytes(3);
        return bin2hex($bytes);
    }

    public function index()
    {


        $auth = Auth::check();
        if (!$auth) {
            $list_post = Paste::orderBy('created_at', 'desc')->paginate(10);
            return view('paste.index', [
                'pastes' => $list_post,
            ]);
        } else {
            //Вывод паст которые созданы юзером
            $list_users = Paste::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
            //Вывод паст которые были созданы недавно
            $list_post = Paste::where('privacy', '!=', 2)->where('privacy', '!=', 1)->orderBy('created_at', 'desc')->paginate(10);

            return view('paste.index', [
                'pastes' => $list_post,
                'list_users' => $list_users
            ]);
        }

    }


    public function create(Request $request)
    {

        if ($request->change_anon) {
            $inputArray = array(
                'link' => $this->linkUrl(),
                'name' => 'Аноним',
                'title' => $request['title'],
                'text' => $request['text'],
                'privacy' => $request['privacy'],
                'expiration' => $request['expiration'],
                'user_id' => $request['user_id'] = null,
            );
        } else {
            $inputArray = array(
                'link' => $this->linkUrl(),
                'name' => $request['name'],
                'title' => $request['title'],
                'text' => $request['text'],
                'privacy' => $request['privacy'],
                'expiration' => $request['expiration'],
                'user_id' => $request['user_id'] = Auth::check() ? Auth::user()->id : null
            );
        }
        $data = Paste::create($inputArray);
        $link = $data['link'];

        return view('paste.link', [
            'link' => $link
        ]);
    }

    public function show()
    {
        $list_users = Paste::where('user_id', Auth::user()->id)->paginate(10);
        return view('paste.show', [
            'list_users' => $list_users
        ]);
    }

    public function getLink($id)
    {
        $link = Paste::where('link', $id)->get()->first();
        if ($link->privacy == "2" and $link->user_id != Auth::user()->id) {
            return 404;
        } else {
            return view('paste.show_link', [
                'link' => $link
            ]);
        }

    }
}
