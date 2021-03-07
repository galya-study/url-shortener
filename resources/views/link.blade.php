@extends('common.app')

@section('title')
    Короткая ссылка
@endsection

@section('body')
    <div class="form-group mb-3">
        <label for="url">URL</label>
        <input type="text" name="url" id="url" class="form-control" value="{{ $link->url }}" disabled>
    </div>

    <div class="form-group mb-3">
        <label for="link">Короткая ссылка</label>
        <input type="text" name="link" id="link" class="form-control" value="{{ $link->full_link }}" disabled>
    </div>

    <div class="form-group mb-3">
        <label for="stat-link">Статистика для короткой ссылки</label>
        <input type="text" name="stat-link" id="stat-link" class="form-control" value="{{ $link->full_stat_link }}" disabled>
    </div>

    <div class="form-group mb-3">
        Коммерческая ссылка: {{ $link->is_commercial_as_string }}
    </div>

    <div class="form-group mb-3">
        Ссылка действительна {{ is_null($link->expires_at) ? 'бессрочно' : ('до ' . $link->expires_at->format('d.m.Y H:i')) }}
    </div>
@endsection
