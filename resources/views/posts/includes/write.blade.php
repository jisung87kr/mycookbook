<div class="form-group">
    <label for="title">제목</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" aria-describedby="helpId" placeholder="제목을 입력하세요" value="{{ old('title', $post->title) }}">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="content">내용</label>
    <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="3">{{ old('content', $post->content) }}</textarea>
    @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    @php
        $postmeta = getPostMeta($post, '__video');
    @endphp
    <label for="video">영상주소</label>
    <input type="text" class="form-control" name="meta[__video]" id="video" aria-describedby="helpId" placeholder="" value="{{ old('meta.__viedo', $postmeta ? $postmeta->value : '') }}">
    @if($postmeta)
        <input type="hidden" name="meta[id]" value="{{ $postmeta->id }}">
    @endif
    <small id="helpId" class="form-text text-muted">
            <ul>
                <li>유투브 : https://youtu.be/mPymRFeTJa4</li>
            </ul>
    </small>
</div>
<div class="form-group">
  <label for="tag">태그</label>
  <input type="text" name="tag" id="tag" class="form-control" placeholder="" aria-describedby="helpId" data-role="tagsinput" value="">
</div>
@push('styles')
    <link rel="stylesheet" href="{{ asset('lib/tagsinput/bootstrap-tagsinput.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('lib/tagsinput/bootstrap-tagsinput.js') }}" defer></script>
@endpush
@include('posts.includes/materialbox')
@include('posts.includes/recipebox')
<div class="justify-content-center d-flex">
    <input type="submit" value="취소" class="btn btn-outline-primary mt-3 mr-2">
    <input type="submit" value="저장" class="btn btn-primary mt-3">
</div>
<script defer>
    window.addEventListener("load", function(){
        $("form").bind("keypress", function (e) {
            if (e.keyCode == 13) {
                return false;
            }
        });

        $('#tag').tagsinput({
            tagClass: 'badge badge-primary', 
        });

        $('.bootstrap-tagsinput input').keydown(function(e){
            var val = $(this).val();
            val = val.replace('#', '');
            $(this).val(val);
        })

        $('#tag').on('itemAdded', function(event) {
            console.log($("#tag").val());
        });

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