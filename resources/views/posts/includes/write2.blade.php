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
<div class="materialbox">
    <div class="materialbox__inner">
        <div class="card form-group material_group mb-3" data-no="1">
            <div class="card-body">
                <div class="form-row">
                    <div class="col">
                        재료
                        <a href="" data-toggle="tooltip" data-placement="top" title="재료 그룹 삭제" class="text-danger btn-del-material_group">
                            <svg class="bi bi-x-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                                <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="col">
                        <div class="form-row">
                            <div class="col">재료명</div>
                            <div class="col">정량</div>
                        </div>
                    </div>
                </div>
                <div class="form-row material">
                    <div class="col material__title">
                        <div class="input-group align-items-center">
                            <div class="input-group-prepend">
                                <span class="material-icons" data-toggle="tooltip" data-placement="top" title="드래그로 순서변경">unfold_more</span>
                            </div>
                            <input type="text" class="form-control rounded-sm @error('material.title') is-invalid @enderror" name="material[1][title]" id="material" aria-describedby="helpId" placeholder="양념장">
                            @error('material.title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col material__item">
                        <div class="material__item__inner">
                            <div class="form-row material__item__row mb-1" data-no="1">
                                <div class="col material__name">
                                    <div class="input-group align-items-center">
                                        <div class="input-group-prepend">
                                            <span class="material-icons" data-toggle="tooltip" data-placement="top" title="드래그로 순서변경">unfold_more</span>
                                        </div>
                                        <input type="text" name="material[1][item][1][name]" id="" class="form-control rounded-sm @error('material.item.name') is-invalid @enderror" placeholder="고추장" aria-describedby="helpId">
                                        @error('material.item.name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col material__unit">
                                    <div class="input-group align-items-center">
                                        <input type="text" name="material[1][item][1][unit]" id="" class="form-control rounded-sm @error('material.item.unit') is-invalid @enderror" placeholder="30g" aria-describedby="helpId">
                                        <div class="input-group-append ml-1">
                                            <a href="" data-toggle="tooltip" data-placement="top" title="재료삭제" class="text-danger btn-del-material">
                                                <svg class="bi bi-x-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                                                    <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        @error('material.item.unit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
        <div class="form-group recipebox">
            <div class="row recipe mb-3" data-no="1">
                <div class="col-12">
                    <a href="" data-toggle="tooltip" data-placement="top" title="재료 그룹 삭제" class="text-danger btn-del-recipe">
                        <svg class="bi bi-x-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                            <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                        </svg>
                    </a>
                </div>
                <div class="col">
                    <div class="input-group align-items-center">
                        <div class="input-group-prepend">
                            <span class="material-icons" data-toggle="tooltip" data-placement="top" title="드래그로 순서변경">unfold_more</span>
                        </div>
                        <textarea class="form-control rounded-sm recipe__content @error('recipe.content') is-invalid @enderror" name="recipe[1][content]" id="" cols="30" rows="5"></textarea>
                        @error('recipe.content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <label for=""></label>
                    <input type="file" class="form-control-file recipe__file" name="recipe[1][file]" id="" placeholder="" aria-describedby="fileHelpId">
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
<script>
    window.addEventListener("load", function(){
        $('[data-toggle="tooltip"]').tooltip();

        $(".materialbox__inner").sortable();
        $(".material__item__inner").sortable();
        $(".recipebox").sortable();

        $("html, body").on('click', '.btn-del-material', function(e){
            e.preventDefault();
            var parent = $(this).closest(".material__item__inner").find(".form-row");
            if(parent.length > 1){
                $(this).closest(".form-row").remove();
            }
        });

        $("html, body").on('click', '.btn-del-material_group', function(e){
            e.preventDefault();
            var group = $(this).closest(".material_group");
            if($(".material_group").length > 1){
                group.remove();
            }
        });

        $("html, body").on('click', '.btn-del-recipe', function(e){
            e.preventDefault();
            var recipe = $(this).closest(".recipe");
            if($(".recipe").length > 1){
                recipe.remove();
            }
        });

        $("html").on('click', '.btn-add-material', function(e){
            e.preventDefault();
            var group = $(this).parents(".material_group");
            var items = $(".material__item__row", group);
            var el = items.eq(0).clone();
            var max = getMaxNo(items);
            el.attr('data-no', max+1);
            el.find(".material__name input").attr('name', 'material['+(group.index()+1)+'][item]['+(max+1)+'][name]').val('');
            el.find(".material__unit input").attr('name', 'material['+(group.index()+1)+'][item]['+(max+1)+'][unit]').val('');
            $(".material__item__inner", group).append(el);
        });

        $(".btn-add-material_class").click(function(e){
            e.preventDefault();
            var groups = $(".material_group");
            var el = groups.eq(0).clone();
            var max = getMaxNo(groups);
            el.attr('data-no', max+1);
            el.find('.material__item__row').not($(".material__item__row", el).eq(0)).remove();
            el.find(".material__title input").attr('name', 'material['+(max+1)+'][title]').val('');
            el.find(".material__name input").attr('name', 'material['+(max+1)+'][item][1][name]').val('');
            el.find(".material__unit input").attr('name', 'material['+(max+1)+'][item][1][unit]').val('');
            $(".materialbox__inner").append(el);
        });

        $("html").on('click', '.btn-add-recipe', function(e){
            e.preventDefault();
            var recipes = $(".recipe");
            var max = getMaxNo(recipes);
            var el = recipes.eq(0).clone();
            el.attr('data-no', max+1);
            el.find(".recipe__content").attr('name', 'recipe['+(max+1)+'][content]').val('');
            el.find(".recipe__file").attr('name', 'recipe['+(max+1)+'][file]').val('');
            $(".recipebox").append(el);
        });

        function getMaxNo(target){
            var arr = [];
            target.each(function(i, item){
                arr.push($(item).attr('data-no'));
            })
            return Math.max.apply(null, arr);
        }
    })
</script>