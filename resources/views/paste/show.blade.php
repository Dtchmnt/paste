@extends('layouts.app') @section('content') @foreach($list_users as $list_user)
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.0.1/styles/default.min.css">
    <div class="container">
        <div class="card">
            <div class="card-header"><h3>{{ $list_user->title }}</h3></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="list-inline">
                            <li>Created by: <i>{{ $list_user->name }}</i></li>
                            <li>Created at: <i>{{ $list_user->created_at }}</i></li>
                            <li>Syntax: <i> {{ is_null($list_user->syntax) ? "Plain-text" : $list_user->syntax }} </i>
                            </li>
                            <li>Ссылка: <a class="/link/{{$list_user['link']}}" href="/link/{{$list_user['link']}}"> <i
                                        class="fas fa-eye"> </i> Посмотреть пасту </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <pre><code
                                class="{{ is_null($list_user->syntax) ? "nohighlight" : $list_user->syntax }}">{{ $list_user->text }}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.0.1/highlight.min.js"></script>
    <script> hljs.initHighlightingOnLoad(); </script> @endforeach @endsection
