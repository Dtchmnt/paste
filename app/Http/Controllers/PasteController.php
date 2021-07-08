<?php

namespace App\Http\Controllers;

use App\Models\Paste;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PasteController extends Controller
{
    protected $userPaste;

    public function __construct(Paste $userPaste)
    {
        $this->userPaste = $userPaste;
    }

    private function linkUrl()
    {
        $createRandomLink = str::random(6);
        return $createRandomLink;
    }

    public function index()
    {
        $auth = Auth::check();
        if (!$auth) {
            $pastes = Paste::where('privacy', '!=', 2)->where('privacy', '!=', 1)->orderBy('created_at', 'desc')->paginate(10);

            $list_post = $this->userPaste->expiration($pastes, true);
            return view('paste.index', [
                'pastes' => $list_post,
            ]);
        } else {

            //Вывод паст которые созданы юзером
            $paste = Paste::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
            //Вывод паст которые были созданы недавно
            $pastes = Paste::where('privacy', '!=', 2)->where('privacy', '!=', 1)->orderBy('created_at', 'desc')->paginate(10);

            $list_post = $this->userPaste->expiration($pastes, true);

            $list_users = $this->userPaste->expiration($paste, true);
            return view('paste.index', [
                'pastes' => $list_post,
                'list_users' => $list_users
            ]);
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'title' => 'required|max:100',
            'text' => 'required',
            'privacy' => 'required',
            'expiration' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json('Проверьте правильность ввода', 403);
        }
        if ($request->change_anon) {
            $inputArray = array(
                'link' => $this->linkUrl(),
                'name' => 'Аноним',
                'title' => $request['title'],
                'text' => $request['text'],
                'privacy' => $request['privacy'],
                'expiration' => $request['expiration'],
                'syntax' => $request['syntax'],
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
                'syntax' => $request['syntax'],
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
        $list_users = $this->userPaste->expiration($paste, true);
        return view('paste.show', [
            'list_users' => $list_users
        ]);
    }

    public function getLink($id)
    {
        $paste = Paste::where('link', $id)->get()->first();
        if ($paste->privacy == "2" and $paste->user_id != Auth::user()->id) {
            return response()->json('Доступ ограничен', 404);
        }
        if ($link = $this->userPaste->expiration($paste, false)) {
            return view('paste.show_link', [
                'link' => $link
            ]);
        }
        return response()->json('Доступ к ссылке истек', 404);
    }
}
