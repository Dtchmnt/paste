<?php

namespace App\Http\Controllers;

use App\Models\Paste;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasteController extends Controller
{
    protected $userPaste;

    public function __construct(Paste $userPaste)
    {
        $this->userPaste = $userPaste;
    }

    private function linkUrl()
    {
        $bytes = random_bytes(3);
        return bin2hex($bytes);
    }

    public function index()
    {
        $auth = Auth::check();
        if (!$auth) {
            $pastes = Paste::where('privacy', '!=', 2)->where('privacy', '!=', 1)->orderBy('created_at', 'desc')->paginate(10);

            $list_post = $this->userPaste->expiration($pastes);
            return view('paste.index', [
                'pastes' => $list_post,
            ]);
        } else {

            //Вывод паст которые созданы юзером
            $paste = Paste::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
            //Вывод паст которые были созданы недавно
            $pastes = Paste::where('privacy', '!=', 2)->where('privacy', '!=', 1)->orderBy('created_at', 'desc')->paginate(10);

            $list_post = $this->userPaste->expiration($pastes);

            $list_users = $this->userPaste->expiration($paste);
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
        $paste = Paste::where('user_id', Auth::user()->id)->paginate(10);
        $list_users = $this->userPaste->expiration($paste);
        return view('paste.show', [
            'list_users' => $list_users
        ]);
    }

    public function getLink($id)
    {
        $link = Paste::where('link', $id)->get()->first();
        return view('paste.show_link', [
            'link' => $link
        ]);
    }
}
