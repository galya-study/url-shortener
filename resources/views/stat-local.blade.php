@extends('common.app')

@section('title')
    Статистика по ссылке
@endsection

@section('body')
    <h1>Статистика по ссылке</h1>
    <div class="form-group mb-3">
        Оригинальный URL:
        <a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a>
    </div>

    <div class="form-group mb-3">
        Короткая ссылка:
        <a href="{{ $link->full_link }}" target="_blank">{{ $link->full_link }}</a>
    </div>

    <div class="form-group mb-3">
        Коммерческая ссылка: {{ $link->is_commercial_as_string }}
    </div>

    <div class="form-group mb-3">
        Ссылка действительна {{ is_null($link->expires_at) ? 'бессрочно' : ('до ' . $link->expires_at->format('d.m.Y H:i')) }}
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">IP-адрес пользователя</th>
            <th scope="col">Ссылка на изображение</th>
            <th scope="col">Дата обращения</th>
        </tr>
        </thead>
        <tbody>
        @foreach($redirects as $redirect)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $redirect->ip_address }}</td>
            <td><a href="{{ $redirect->image_url }}" target="_blank">{{ $redirect->image_url }}</a></td>
            <td>{{ $redirect->created_at->format('d.m.Y H:i') }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
