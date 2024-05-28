@extends('layouts.app')

@section('content')
<form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')
    @foreach (config('translatable.locales') as $locale)
        <div>
            <label for="title_{{ $locale }}">{{ __('Title (') . $locale . ')' }}</label>
            <input type="text" id="title_{{ $locale }}" name="translations[{{ $locale }}][title]" value="{{ $post->getTranslation('title', $locale) }}" required>
        </div>
        <div>
            <label for="content_{{ $locale }}">{{ __('Content (') . $locale . ')' }}</label>
            <textarea id="content_{{ $locale }}" name="translations[{{ $locale }}][content]" required>{{ $post->getTranslation('content', $locale) }}</textarea>
        </div>
    @endforeach
    <button type="submit">{{ __('Update') }}</button>
</form>
@endsection
