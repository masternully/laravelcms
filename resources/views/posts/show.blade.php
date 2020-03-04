@extends('layouts.app')
@section('content')
<div class="container mt-5">
Название: {{ $post->title }}
<br>
Полный текст: {{ $post->body }}
</div>
@endsection