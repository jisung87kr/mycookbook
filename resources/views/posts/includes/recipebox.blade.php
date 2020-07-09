<div class="card mt-4">
    <div class="card-body">
        <h6>요리순서</h6>
        <div class="form-group recipebox">
            @if(is_null($post->id))
                @include('posts.includes.recipe', [
                    'recipe' => null,
                    'key' => 0
                ])
            @else
                @foreach($post->recipes as $key => $recipe)
                    @include('posts.includes.recipe')
                @endforeach
            @endif
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