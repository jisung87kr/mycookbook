<div class="card form-group material_group mb-3" data-no="{{ $key }}">
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
                    <input type="text" class="form-control rounded-sm @error('material.title') is-invalid @enderror" name="material[{{ $key }}][title]" id="material" aria-describedby="helpId" placeholder="양념장" value="{{ old('material.title', is_null($materialClass) ? '' : $materialClass->title ) }}">
                    @error('material.title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col material__item">
                <div class="material__item__inner">
                    @if(is_null($post->id))
                        @include('posts.includes.material_item', [
                            'unit' => null,
                            'i' => 0
                        ])
                    @else
                        @foreach($materialClass->materialUnits as $i => $unit)
                            @include('posts.includes.material_item')
                        @endforeach
                    @endif
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