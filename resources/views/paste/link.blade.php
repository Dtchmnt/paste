@extends('layouts.app')
@section('title', 'Ссылка на пасту')

@section('content')
    <form>
             <a href="/link/{{$link}}">{{Request::root().'/link/'.$link}}</a>


    </form>
@endsection
