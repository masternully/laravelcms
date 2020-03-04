@extends('layouts.app')
@section('content')
<div class="container mt-5">
<h1>All posts</h1>
@foreach($posts as $post)
<a href="{{ route('posts.show', $post->id) }}">
    {{ $post->title }}
</a>
({{$post->created_date}})
<hr>
@endforeach
</div>
@endsection
