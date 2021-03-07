@extends('common.app')

@section('title')
    Главная
@endsection

@section('body')
    <form action="{{ route('save') }}" method="post">
        @csrf

        @include('errors')

        <div class="form-group mb-3">
            <label for="url">Введите URL</label>
            <input type="text" name="url" id="url" placeholder="URL" class="form-control" value="{{ old('url') }}">
        </div>

        <div class="form-group">
            <label for="link">Введите свой текст для короткой ссылки</label>
            <div class="input-group mb-3">
                <span class="input-group-text">{{ env('APP_URL') }}</span>
                <input type="text" name="link" id="link" class="form-control" value="{{ old('link') }}">
            </div>
        </div>

        <div class="form-group mb-3">
            <label>Укажите срок действия ссылки</label>
            <div class="input-group">
                <span class="input-group-text">Дата и время</span>
                <input type="date" name="expires_at[date]" min="{{ \Carbon\Carbon::today()->toDateString() }}" class="form-control" value="{{ old('expires_at.date') }}">
                <input type="time" name="expires_at[time]" class="form-control" value="{{ old('expires_at.time') }}">
            </div>
        </div>

        <div class="form-group mb-3">
            <div class="form-check">
                <input type="hidden" name="is_commercial" value="0">
                <input type="checkbox" name="is_commercial" id="is-commercial" class="form-check-input" value="1" {{ old('is_commercial') == 1 ? 'checked' : '' }}>
                <label for="is-commercial" class="form-check-label">
                    Коммерческая ссылка
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Уменьшить</button>
    </form>
@endsection
