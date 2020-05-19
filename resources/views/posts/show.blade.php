@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/JIkhS0AbnoQ?rel=0" allowfullscreen></iframe>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $post->title }}</h4>
                        <div class="small">{{ $post->updated_at->diffForHumans() }}</div>
                        <hr/>
                        <p class="card-text">{{ $post->content }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    @foreach($post->materialClasses as $materialClass)
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                {{ $materialClass->title }}
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($materialClass->materials as $material)
                                <li class="list-group-item">
                                    <span class="float-left">{{ $material->name}}</span>
                                    <span class="text-muted float-right">{{ $material->unit }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
                <ol class="list-unstyled">
                    <li>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-3">STEP.1</h5>
                                        <p>
                                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                        </p>
                                    </div>
                                    <img class="mr-3" src="holder.js/200x200/" alt="">
                                </div>
                            </div>
                        </div>
                    </li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="mb-3">내용 더 보기</div>
                <div class="card mb-2">
                    <div class="card-body">
                        @forelse($posts as $post)
                        <div class="media mb-3">
                            <img class="mr-3" src="holder.js/100x60/" alt="">
                            <div class="media-body">
                                <a href="{{ route('posts.show', $post->id) }}">
                                    <div class="mt-0">{{ $post->title }}</div>
                                </a>
                            </div>
                        </div>
                        @empty
                        내용이 없습니다.
                        @endforelse
                    </div>
                </div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection