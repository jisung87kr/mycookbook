@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mb-5">
            <div class="card-body">
                <form action="{{ route('posts.index') }}" id="form-materials" method="GET">
                    <div>
                        <h5>사용할 재료를 선택해주세요</h5>
                        <input type="submit" class="btn btn-primary mb-3" value="요리찾기">
                    </div>
                    <div class="overflow-auto mb-3 material_list">
                        <div class="row" style="height: 200px">
                            @foreach($materials as $key => $material)
                            <div class="col-6 col-md-4 col-lg-2">
                                <div class="form-check">
                                    <input type="checkbox"
                                    class="form-check-input"
                                    name="selected_material[]"
                                    id="material_{{ $key }}"
                                    value="{{ $material->name }}"
                                    @if($selectedMaterial && in_array($material->name, $selectedMaterial)) checked @endif
                                    >
                                    <label class="form-check-label" for="material_{{ $key }}">{{ $material->name }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </form> 
            </div>
        </div>
        <div class="row">
            @if(app('request')->input('selected_material'))
            <div class="col-12">
                <div class="alert alert-primary" role="alert">
                    @foreach($selectedMaterial as $material)
                    '{{ $material }}'@if(!$loop->last),@endif
                    @endforeach
                    와 관련된 {{ $posts->total() }}개의 레시피가 조회되었습니다.
                </div>
            </div>
            @elseif((app('request')->input('taxonomy')))
            <div class="col-12">
                <div class="alert alert-primary" role="alert">
                    '{{App\term::where('slug', app('request')->input('taxonomy'))->value('name')}}' 에 대한 {{ $posts->total() }}개의 레시피가 조회되었습니다.
                </div>
            </div>
            @endif
        @forelse($posts as $post)
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="card">
                    <img class="card-img-top w-100" src="holder.js/300x180/" alt="">
                    <div class="card-body">
                        <a href="{{ route('posts.show', [$post->id, 'selected_material' => $selectedMaterial]) }}" class="text-dark">
                            <h4 class="card-title">{{ $post->title }}</h4>
                            <p class="card-text">{{ Str::limit($post->content, $limit = 150, $end = '...') }}</p>
                        </a>
                        @include('posts.includes.taxonomy', ['post' => $post])
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">내용이 없습니다.</div>
        @endforelse
        </div>
        {{ $posts->appends([
            'selected_material' => $selectedMaterial,
            'taxonomy' => app('request')->input('taxonomy')
        ])->links() }}
    </div>
@endsection