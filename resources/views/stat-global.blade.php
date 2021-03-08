@extends('common.app')

@section('title')
    Общая статистика
@endsection

@section('body')
    <h1>Общая статистика</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Оригинальный URL</th>
            <th scope="col">Короткая ссылка</th>
            <th scope="col">Коммерческая ссылка</th>
            <th scope="col">Количество уникальных переходов</th>
            <th scope="col">Дата действия ссылки</th>
        </tr>
        </thead>
        <tbody>
        @foreach($links as $link)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a></td>
                <td><a href="{{ $link->full_link }}" target="_blank">{{ $link->full_link }}</a></td>
                <td>{{ $link->is_commercial_as_string }}</td>
                <td>{{ $link->redirects->where('created_at', '>=', \Carbon\Carbon::now()->subDays(14))->groupBy('ip_address')->count() }}</td>
                <td>{{ is_null($link->expires_at) ? 'бессрочно' : $link->expires_at->format('d.m.Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
