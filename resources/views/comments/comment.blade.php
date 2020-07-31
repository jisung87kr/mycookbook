<div class="card mb-2 comment-card" style="margin-left: {{ 30*($depth-1) }}px">
    <div class="card-body">
        <div class="clearfix">
            <div class="float-left">
                <span>{{ $comment->user->name }}</span>
                <small class="text-muted ml-2">{{ $comment->updated_at->diffForHumans() }}</small>
            </div>
            <div class="d-inlinebloc float-right">
                @can('edit-comment', $comment)
                <a href="" class="btn btn-outline-secondary btn-sm modify-comment">수정</a>
                <a href="{{ route('comments.destroy', $comment) }}"
                class="btn btn-outline-danger btn-sm delete-comment" data-id="{{ $comment->id }}">삭제</a>
                <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                @csrf
                @method('DELETE')
                </form>
                @endcan
            </div>
        </div>
        <hr>
        <div class="">{{ $comment->comment }}</div>
    </div>
    <div class="p-4">
        @include('comments.create')
    </div>
</div>
@foreach($comment->comments as $reply)
    @include('comments.comment', [
        'comment' => $reply,
        'depth' => $loop->depth
    ])
@endforeach