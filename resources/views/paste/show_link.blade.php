@extends('layouts.app')
@section('title', 'Добавить пасту')
@section('content')
    @foreach($link as $item)
         <link rel="stylesheet"
              href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.0.1/styles/default.min.css">
        <div class="container">
            <div class="card">
                <div class="card-header"><h3>{{ $item->title }}</h3></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="list-inline">
                                <li>Created by: <i>{{ $item->name }}</i></li>
                                <li>Created at: <i>{{ $item->created_at }}</i></li>
                                <li>Syntax: <i> {{ is_null($item->syntax) ? "Plain-text" : $item->syntax }} </i></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <pre><code
                                    class="{{ is_null($item->syntax) ? "nohighlight" : $item->syntax }}">{{ $item->text }}</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.0.1/highlight.min.js"></script>
        <script>
            hljs.initHighlightingOnLoad();
        </script>
    @endforeach
@endsection
