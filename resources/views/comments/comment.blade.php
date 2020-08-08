<div class="card mb-2 comment-card" style="margin-left: {{ 30*($depth-1) }}px">
    <div class="card-body">
        <div class="clearfix">
            <div class="float-left">
                <span>{{ $comment->user->name }}</span>
                <small class="text-muted ml-2">{{ $comment->updated_at->diffForHumans() }}</small>
            </div>
            <div class="d-inlinebloc float-right">
                @if(!$comment->trashed())
                @can('edit-comment', $comment)
                <a href="" class="btn btn-outline-info btn-sm create-comment">댓글</a>
                <a href="" class="btn btn-outline-secondary btn-sm modify-comment">수정</a>
                <a href="{{ route('comments.destroy', $comment) }}"
                class="btn btn-outline-danger btn-sm delete-comment" data-id="{{ $comment->id }}">삭제</a>
                <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                @csrf
                @method('DELETE')
                </form>
                @endcan
                @endif
            </div>
        </div>
        <hr>
        <div class="">
        @if($comment->trashed())
        삭제된 댓글 입니다.
        @else
            <div class="">
                {{ $comment->comment }}
            </div>
            @include('comments.edit')
            <div class="mt-2">
                @include('comments.create')
            </div>
        @endif
        </div>
    </div>
</div>
@foreach($comment->comments as $reply)
    @include('comments.comment', [
        'comment' => $reply,
        'depth' => $loop->depth
    ])
@endforeach