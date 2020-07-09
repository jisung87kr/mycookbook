<div class="form-row material__item__row mb-1" data-no="{{ $i }}">
    <div class="col material__name">
        <div class="input-group align-items-center">
            <div class="input-group-prepend">
                <span class="material-icons" data-toggle="tooltip" data-placement="top" title="드래그로 순서변경">unfold_more</span>
            </div>
            <input type="text" name="material[{{ $key }}][item][{{ $i }}][name]" id="" class="form-control rounded-sm @error('material.item.name') is-invalid @enderror" placeholder="고추장" aria-describedby="helpId" value="{{ old('material.item.name', is_null($unit) ? '' : $unit->material->name) }}">
            @error(' material.item.name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col material__unit">
        <div class="input-group align-items-center">
            <input type="text" name="material[{{ $key }}][item][{{ $i }}][unit]" id="" class="form-control rounded-sm @error('material.item.unit') is-invalid @enderror" placeholder="30g" aria-describedby="helpId" value="{{ old('material.item.unit', is_null($unit) ? '' : $unit->unit) }}">
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