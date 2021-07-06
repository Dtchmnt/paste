@extends('layouts.app')
@section('title', 'Добавить пасту')

@section('content')
    <form method="post" action="№">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="text">Название</label>
                            <input type="text" class="form-control" id="text" placeholder="Название пасты">
                        </div>
                        <div class="form-group">
                            <label for="title">Новая паста</label>
                            <textarea class="form-control" id="title" rows="14"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="name">Введите имя</label>
                            <input type="email" class="form-control" id="name" placeholder="Имя">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="anon"
                                   id="anon">
                            <label class="form-check-label" for="anon">
                                Анонимно
                            </label>
                        </div>
                        <button type="button" class="btn btn-primary">Сохранить</button>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="expiration">Время жизни</label>
                            <select class="form-control" id="expiration">
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
                            <select class="form-control" id="privacy">
                                <option value="0">Доступна всем</option>
                                <option value="1">Доступна только по ссылке</option>
                                <option value="2">Доступная только мне</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    @include('paste.list')
                </div>
            </div>
        </div>
    </form>
@endsection
