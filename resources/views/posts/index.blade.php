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
                            <div class="col-lg-2">
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
        @forelse($posts as $post)
            <div class="col-md-3 col-6 mb-4">
                <div class="card">
                    <img class="card-img-top w-100" src="holder.js/300x180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">{{ $post->title }}</h4>
                        <p class="card-text">{{ Str::limit($post->content, $limit = 150, $end = '...') }}</p>
                        <a href="{{ route('posts.show', [$post->id, 'selected_material' => $selectedMaterial]) }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">내용이 없습니다.</div>
        @endforelse
        </div>
        {{ $posts->appends(['selected_material' => $selectedMaterial])->links() }}
    </div>
@endsection