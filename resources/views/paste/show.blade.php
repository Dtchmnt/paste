@extends('layouts.app')
@section('title', 'Добавить пасту')

@section('content')
    @foreach($list_users as $list_user)
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{$list_user->title}}</h5>
                    <h5 class="mb-1">{{$list_user->text}}</h5>
                    <small>{{$list_user->expiration}}</small>
                </div>
                <p class="mb-1">{{$list_user->name}}</p>
                <small>che to</small>
            </a>
        </div>
    @endforeach
@endsection
