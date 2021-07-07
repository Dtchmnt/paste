@extends('layouts.app')
@section('title', 'Добавить пасту')
@section('content')
    @if(!empty($link))
        <link rel="stylesheet"
              href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.0.1/styles/default.min.css">
        <div class="container">
            <div class="card">
                <div class="card-header"><h3>{{ $link->title }}</h3></div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="list-inline">
                                <li>Created by: <i>{{ $link->name }}</i></li>
                                <li>Created at: <i>{{ $link->created_at }}</i></li>
                                <li>Syntax: <i> {{ is_null($link->syntax) ? "Plain-text" : $link->syntax }} </i></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <pre><code
                                    class="{{ is_null($link->syntax) ? "nohighlight" : $link->syntax }}">{{ $link->text }}</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.0.1/highlight.min.js"></script>
        <script>
            hljs.initHighlightingOnLoad();
        </script>
    @endif
@endsection
