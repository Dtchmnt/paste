@extends('layouts.app')
@section('title', 'Добавить пасту')

@section('content')
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{$link->title}}</h5>
                    <h5 class="mb-1">{{$link->text}}</h5>
                    <small>{{$link->expiration}}</small>
                </div>
                <p class="mb-1">{{$link->name}}</p>
                <small>che to</small>
            </a>
        </div>
@endsection
