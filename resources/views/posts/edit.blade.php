@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('posts/includes/write')
        </form>
    </div>
@endsection