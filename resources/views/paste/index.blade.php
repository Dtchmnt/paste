@extends('layouts.app')
@section('title', 'Добавить пасту')

@section('content')
    <form method="POST" action="/create">
        <div class="content-header">
            <div class="container-fluid">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="text">Название</label>
                            <input type="text" class="form-control" name="title" placeholder="Название пасты">
                        </div>
                        <div class="form-group">
                            <label for="title">Новая паста</label>
                            <textarea class="form-control" name="text" rows="14"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="name">Введите имя</label>
                            <input type="text" class="form-control" name="name" placeholder="Имя">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="change_anon"
                                   id="change_anon">
                            <label class="form-check-label" for="change_anon">
                                Анонимно
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="expiration">Время жизни</label>
                            <select class="form-control" name="expiration">
                                <option value="0">10 минут</option>
                                <option value="1">1 час</option>
                                <option value="2">3 часа</option>
                                <option value="3">1 день</option>
                                <option value="4">1 неделя</option>
                                <option value="5">1 месяц</option>
                                <option value="6">Без ограничений</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="privacy">Приватность</label>
                            <select class="form-control" name="privacy">
                                <option value="0">Доступна всем</option>
                                <option value="1">Доступна только по ссылке</option>
                                <option value="2" @if (Auth::user()==null) disabled @endif>Доступен только мне
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="syntax">Syntax</label>
                            <select class="form-control" name="syntax" id="syntax">
                                <option value="" selected="selected">None</option>
                                <option value="PHP">php</option>
                                <option value="JS">js</option>
                            </select>
                        </div>
                        <div class="ml-5 mt-4">
                            <button type="submit" name="create" class="btn btn-primary">Добавить</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="expiration">Последние 10 новых постов</label>
                        @include('paste.list')
                    </div>
                    <div class="col-sm-6">
                        <label for="expiration">Последние 10 новых постов авторизованого пользователя</label>
                        @include('paste.list_user')
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection
