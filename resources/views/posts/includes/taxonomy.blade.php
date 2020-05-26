@if(postHasTaxonomy($post, 'category') || postHasTaxonomy($post, 'tag'))
<hr/>
@endif
@if(postHasTaxonomy($post, 'category'))
<div class="position-relative pl-4">
    <svg class="position-absolute bi bi-archive" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="left:0; top: 4px;">
        <path fill-rule="evenodd" d="M2 5v7.5c0 .864.642 1.5 1.357 1.5h9.286c.715 0 1.357-.636 1.357-1.5V5h1v7.5c0 1.345-1.021 2.5-2.357 2.5H3.357C2.021 15 1 13.845 1 12.5V5h1z"/>
        <path fill-rule="evenodd" d="M5.5 7.5A.5.5 0 0 1 6 7h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5zM15 2H1v2h14V2zM1 1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H1z"/>
    </svg>
    <div class="">
        @foreach($post->taxonomies()->where('taxonomy', 'category')->get() as $taxonomy)
            <a href="{{ route('posts.index', ['taxonomy' => $taxonomy->term->slug]) }}" class="text-muted">{{ $taxonomy->term->name }}@if(!$loop->last), @endif</a>
        @endforeach
    </div>
</div>
@endif
@if(postHasTaxonomy($post, 'tag'))
<div class="position-relative pl-4">
    <svg class="position-absolute bi bi-tag" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="left:0; top: 4px;">
        <path fill-rule="evenodd" d="M.5 2A1.5 1.5 0 0 1 2 .5h4.586a1.5 1.5 0 0 1 1.06.44l7 7a1.5 1.5 0 0 1 0 2.12l-4.585 4.586a1.5 1.5 0 0 1-2.122 0l-7-7A1.5 1.5 0 0 1 .5 6.586V2zM2 1.5a.5.5 0 0 0-.5.5v4.586a.5.5 0 0 0 .146.353l7 7a.5.5 0 0 0 .708 0l4.585-4.585a.5.5 0 0 0 0-.708l-7-7a.5.5 0 0 0-.353-.146H2z"/>
        <path fill-rule="evenodd" d="M2.5 4.5a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm2-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
    </svg>
    <div class="">
        @foreach($post->taxonomies()->where('taxonomy', 'tag')->get() as $taxonomy)
            <a href="{{ route('posts.index', ['taxonomy' => $taxonomy->term->slug]) }}" class="text-muted">#{{ $taxonomy->term->name }}</a>
        @endforeach
    </div>
</div>
@endif