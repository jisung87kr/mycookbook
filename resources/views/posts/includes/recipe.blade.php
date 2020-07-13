<div class="row recipe mb-3" data-no="{{ $key }}">
    <div class="col-12">
        <a href="" data-toggle="tooltip" data-placement="top" title="조리과정 삭제" class="text-danger btn-del-recipe">
            <svg class="bi bi-x-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
            </svg>
        </a>
    </div>
    <div class="col recipe-content">
        <div class="input-group align-items-center">
            <div class="input-group-prepend">
                <span class="material-icons" data-toggle="tooltip" data-placement="top" title="드래그로 순서변경">unfold_more</span>
            </div>
            @if($recipe)
                <input type="hidden" name="recipe[{{$key}}][id]" value="{{ $recipe->id }}">
            @endif
            <textarea class="form-control rounded-sm recipe__content @error('recipe.content') is-invalid @enderror" name="recipe[{{ $key }}][content]" id="" cols="30" rows="5">{{ old('recipe.content', is_null($recipe) ? '' : $recipe->content) }}</textarea>
            @error('recipe.content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col recipe-file">
        @if($recipe)
            <input type="file" class="form-control-file recipe__file" name="recipe[{{$key}}][file][]" id="" placeholder="" aria-describedby="fileHelpId" multiple>
            <small id="fileHelpId" class="form-text text-muted">요리과정 이미지를 올려주세요.</small>
            @foreach($recipe->attachments as $j => $file)
                <img src="{{ asset($file->path) }}" alt="" style="max-width: 100px">
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="recipe[{{$key}}][file_delete][{{$j}}]" id="delete{{$key.'_'.$j}}" class="form-check-input" value="{{ $file->id }}">
                        <label for="delete{{$key.'_'.$j}}" class="form-check-label">삭제</label>
                    </div>
                </div>
            @endforeach
        @else
            <input type="file" class="form-control-file recipe__file" name="recipe[{{$key}}][file][]" id="" placeholder="" aria-describedby="fileHelpId" multiple>
            <small id="fileHelpId" class="form-text text-muted">요리과정 이미지를 올려주세요.</small>
        @endif
    </div>
</div>