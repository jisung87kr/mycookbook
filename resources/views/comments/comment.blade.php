<div class="card mb-2" style="margin-left: {{ 30*($depth-1) }}px">
    <div class="card-body">
        <div>
            <span>{{ $comment->user->name }}</span>
            <small class="text-muted ml-2">{{ $comment->updated_at->diffForHumans() }}</small>
        </div>
        <hr>
        <div class="">{{ $comment->comment }}</div>
    </div>
</div>
@foreach($comment->comments as $reply)
    @include('comments.comment', [
        'comment' => $reply,
        'depth' => $loop->depth
    ])
@endforeach