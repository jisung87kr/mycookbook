@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
        @forelse($posts as $post)
            <div class="col-3 mb-4">
                <div class="card">
                    <img class="card-img-top w-100" src="holder.js/300x180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">{{ $post->title }}</h4>
                        <p class="card-text">{{ Str::limit($post->content, $limit = 150, $end = '...') }}</p>
                        <a href="{{ route('posts.show', $post->id) }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">내용이 없습니다.</div>
        @endforelse
        </div>
        {{ $posts->links() }}
    </div>
@endsection