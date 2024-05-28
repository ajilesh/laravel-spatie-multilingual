@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Laravel Yajra Datatables Example</h2>
    <table class="table table-bordered" id="users-table">
        <thead>
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Content</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
{{-- @foreach ($posts as $post)
    <h2>{{ $post->getTranslation('title', app()->getLocale()) }}</h2>
    <p>{{ $post->getTranslation('content', app()->getLocale()) }}</p>
    <a href="{{ route('posts.edit', $post->id) }}">{{ __('Edit') }}</a>
    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">{{ __('Delete') }}</button>
    </form>
@endforeach --}}
<a href="{{ route('posts.create') }}">{{ __('Create Post') }}</a>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
      
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('posts.data') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'title', name: 'title' },
                { data: 'content', name: 'content' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection
