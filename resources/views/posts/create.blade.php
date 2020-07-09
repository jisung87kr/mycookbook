@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('posts.store') }}" method="post">
            @csrf
            @include('posts/includes/write')
        </form>
    </div>
@endsection