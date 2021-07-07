@extends('layouts.app')

@section('title', 'Все пользователи')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        Все пользователи
                    </h1>
                </div>
            </div>

        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th style="width: 10%">
                                Имя
                            </th>
                            <th style="width: 10%">
                                Название
                            </th>
                            <th style="width: 30%">
                                Паста
                            </th>
                            <th style="width: 30%">
                                Ссылка
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list_users as $list_user)
                            <tr>
                                <td>
                                    {{$list_user['name']}}
                                </td>
                                <td>
                                    {{$list_user['title']}}
                                </td>
                                <td>
                                    {{$list_user['text']}}
                                </td>

                                <td class="project-actions">
                                    <a class="btn btn-primary btn-sm" href="/link/{{$list_user['link']}}">
                                        <i class="fas fa-eye">
                                        </i>
                                        Посмотреть пасту
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            {{ $list_users->links() }}
        </div>

    </section>

@endsection
