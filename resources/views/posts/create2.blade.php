@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('posts.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">제목</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" aria-describedby="helpId" placeholder="제목을 입력하세요">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">내용</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="3"></textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="video">영상주소</label>
                <input type="text" class="form-control" name="meta[__video]" id="video" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">
                        <ul>
                            <li>유투브 : https://youtu.be/mPymRFeTJa4</li>
                        </ul>
                </small>
            </div>
            <div class="material">
                <div class="card form-group">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col">재료</div>
                            <div class="col">
                                <div class="form-row">
                                    <div class="col">재료명</div>
                                    <div class="col">정량</div>
                                </div>
                            </div>
                        </div>
                        <div id="materialClass_1" class="form-row material__row">
                            <div class="col material__title">
                                <div class="input-group align-items-center">
                                    <div class="input-group-prepend">
                                        <span class="material-icons" data-toggle="tooltip" data-placement="top" title="드래그로 순서변경">unfold_more</span>
                                    </div>
                                    <input type="text" class="form-control rounded-sm" name="material_title_1" id="material" aria-describedby="helpId" placeholder="양념장">
                                </div>
                            </div>
                            <div class="col material__item">
                                <div class="material__item__inner">
                                    <div class="form-row">
                                        <div class="col material__name">
                                            <div class="input-group align-items-center">
                                                <div class="input-group-prepend">
                                                    <span class="material-icons" data-toggle="tooltip" data-placement="top" title="드래그로 순서변경">unfold_more</span>
                                                </div>
                                                <input type="text" name="material_name_1[]" id="" class="form-control rounded-sm" placeholder="고추장" aria-describedby="helpId">
                                            </div>
                                        </div>
                                        <div class="col material__unit">
                                            <div class="input-group align-items-center">
                                                <input type="text" name="material__unit_1[]" id="" class="form-control rounded-sm" placeholder="30g" aria-describedby="helpId">
                                                <div class="input-group-append ml-1">
                                                    <a href="" data-toggle="tooltip" data-placement="top" title="재료삭제" class="text-danger btn-del-material">
                                                        <svg class="bi bi-x-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                            <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                                                            <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-2">
                                    <a href="" data-toggle="tooltip" data-placement="top" title="재료 추가" class="text-default btn-add-material">
                                        <svg class="bi bi-plus-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
                                            <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
                                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-2">
                    <a href="" data-toggle="tooltip" data-placement="top" title="재료그룹 추가" class="text-default btn-add-material_class">
                        <svg class="bi bi-plus-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <h6>요리순서</h6>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="input-group align-items-center">
                                    <div class="input-group-prepend">
                                        <span class="material-icons" data-toggle="tooltip" data-placement="top" title="드래그로 순서변경">unfold_more</span>
                                    </div>
                                    <textarea class="form-control rounded-sm" name="recipe[1][content]" id="" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col">
                                <label for=""></label>
                                <input type="file" class="form-control-file" name="" id="" placeholder="" aria-describedby="fileHelpId">
                                <small id="fileHelpId" class="form-text text-muted">요리과정 이미지를 올려주세요.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-2 mb-4">
                    <a href="" data-toggle="tooltip" data-placement="top" title="요리순서 추가" class="text-default btn-add-recipe">
                        <svg class="bi bi-plus-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="justify-content-center d-flex">
                <input type="submit" value="취소" class="btn btn-outline-primary mt-3 mr-2">
                <input type="submit" value="저장" class="btn btn-primary mt-3">
            </div>
        </form>
    </div>
    <script>
    window.addEventListener("load", function(){
        $('[data-toggle="tooltip"]').tooltip();

        $(".btn-add-material").click(function(e){
            e.preventDefault();
            var el = $(".material__item .form-row").eq(0).clone();
            $(".material__item__inner").append(el);
        });

        $("html").on('click', '.btn-del-material', function(e){
            e.preventDefault();
            var parent = $(".material__item__inner").find(".form-row");
            if(parent.length > 1){
                $(this).closest(".form-row").remove();
            }
        });

        $(".btn-add-material_class").click(function(){
            var el = $(".material-row").eq(0).clone();
            
        });
    })
    </script>
@endsection