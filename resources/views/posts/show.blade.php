@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/JIkhS0AbnoQ?rel=0" allowfullscreen></iframe>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $post->title }}</h4>
                        <div class="small">{{ $post->updated_at->diffForHumans() }}</div>
                        <hr/>
                        <p class="card-text">{{ $post->content }}</p>
                        @include('posts.includes.taxonomy', ['post' => $post])
                    </div>
                </div>
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary mt-3">수정</a>
                <a href="{{ route('posts.destroy', $post->id) }}" class="btn btn-danger mt-3" onclick="event.preventDefault(); document.getElementById('delete-post').submit()">삭제</a>
                <form action="{{ route('posts.destroy', $post->id) }}" id="delete-post" method="POST">
                @csrf
                @method('DELETE')
                </form>
                <div class="row mt-3">
                    @foreach($post->materialClasses as $materialClass)
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                {{ $materialClass->title }}
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($materialClass->materialUnits as $material)
                                <li class="list-group-item">
                                    <span class="float-left">{{ $material->material->name}}</span>
                                    <span class="text-muted float-right">{{ $material->unit }}</span>
                                    @if(app('request')->input('selected_material'))
                                        @if(in_array($material->material->name, app('request')->input('selected_material')))
                                        <svg class="bi bi-check-circle float-left ml-2 mt-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" color="green" data-toggle="tooltip" data-placement="top" title="가지고 있는 재료">
                                            <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3-3a.5.5 0 11.708-.708L8 9.293l6.646-6.647a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                                            <path fill-rule="evenodd" d="M8 2.5A5.5 5.5 0 1013.5 8a.5.5 0 011 0 6.5 6.5 0 11-3.25-5.63.5.5 0 11-.5.865A5.472 5.472 0 008 2.5z" clip-rule="evenodd"/>
                                        </svg>
                                        @endif
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="card store">
                    <div class="card-body">
                        <h4 class="mb-3 text-center">부족한 요리재료를 구매하세요</h4>
                        <!-- <iframe src="https://coupa.ng/bCTGY8" width="100%" height="44" frameborder="0" scrolling="no"></iframe> -->
                        <iframe src="https://coupa.ng/bCTGZa" width="100%" height="36" frameborder="0" scrolling="no" class="mb-1"></iframe>
                        @if($materialList)  
                            @foreach($materialList as $item)
                                <a href="{{ $item->link }}" target="_blank">
                                    <span class="btn-dark btn-sm">{{ $item->name }}</span>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
                <ol class="list-unstyled">
                    @foreach($post->recipes()->orderBy('step', 'ASC')->get() as $recipe)
                    <li>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-3">STEP.{{ $recipe->step }}</h5>
                                        <p>
                                            {{ $recipe->content }}
                                        </p>
                                    </div>
                                    @foreach($recipe->attachments as $key => $val)
                                    <img class="ml-3" src="{{ asset($val->path) }}" alt="" style="max-width: 150px">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ol>
                <div class="commentbox mt-5">
                    @include('comments.index')
                </div>
            </div>
            <div class="col-lg-4">
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
                {{ $posts->appends(['selected_material' => app('request')->input('selected_material')])->links() }}
                <div class="mt-5 mb-3">읽어본글</div>
                <div class="card mb-2">
                    <div class="card-body">
                        @forelse($recentList as $key => $list)
                        @if(is_null($list)) @continue @endif
                        <div class="media mb-3">
                            <img class="mr-3" src="holder.js/100x60/" alt="">
                            <div class="media-body">
                                <a href="{{ route('posts.show', $list->id) }}">
                                    <div class="mt-0">{{ $list->title }}</div>
                                </a>
                            </div>
                        </div>
                        @empty
                        내용이 없습니다.
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    window.addEventListener('load', function(){
        $('[data-toggle="tooltip"]').tooltip();
    })
    </script>
@endsection