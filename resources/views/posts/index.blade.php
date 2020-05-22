@php
    $queryString = app('request')->input('materials') ? app('request')->input('materials') : null;
    $arrayMaterial = explode(',', $queryString);
@endphp
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mb-5">
            <div class="card-body">
                <form action="{{ route('posts.index') }}" id="form-materials" method="GET">
                    <h5>사용할 재료를 선택해주세요</h5>
                    <div class="form-group">
                        <input type="text" 
                        class="form-control material_list_text"
                        name="materials"
                        id=""
                        readonly
                        value="@isset($queryString) {{ $queryString }} @endisset
                        ">
                        <small id="helpId" class="form-text text-muted">수정을 하시려면 선택한 체크박스를 해제하세요</small>
                    </div>
                    <input type="submit" class="btn btn-primary mb-3" value="요리찾기">
                </form> 
                <div class="overflow-auto mb-3 material_list">
                    <div class="row" style="height: 200px">
                        @foreach($materials as $key => $material)
                        <div class="col-lg-2">
                            <div class="form-check">
                                <input type="checkbox"
                                class="form-check-input"
                                name="material[]"
                                id="material_{{ $key }}"
                                value="{{ $material->name }}"
                                @if(in_array($material->name, $arrayMaterial)) checked @endif
                                >
                                <label class="form-check-label" for="material_{{ $key }}">{{ $material->name }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <script>
                    window.addEventListener('load', function(){
                        $(".material_list input[type='checkbox']").click(function(){
                            var arr = [];
                            $(".material_list input[type='checkbox']").each(function(){
                                if($(this).prop('checked')){
                                    arr.push($(this).val());
                                }
                            });
                            $(".material_list_text").val(arr);
                        });
                    });
                </script>
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
                        <a href="{{ route('posts.show', $post->id) }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">내용이 없습니다.</div>
        @endforelse
        </div>
        {{ $posts->appends(['materials' => $queryString])->links() }}
    </div>
@endsection