@extends('layouts.app')

@section('content')
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    @foreach (config('translatable.locales') as $locale)
        <div>
            <label for="title_{{ $locale }}">{{ __('Title (') . $locale . ')' }}</label>
            <input type="text" id="title_{{ $locale }}" name="translations[{{ $locale }}][title]" required>
        </div>
        <div>
            <label for="content_{{ $locale }}">{{ __('Content (') . $locale . ')' }}</label>
            <textarea id="content_{{ $locale }}" name="translations[{{ $locale }}][content]" required></textarea>
        </div>
    @endforeach
    <button type="submit">{{ __('Submit') }}</button>
</form>
@endsection