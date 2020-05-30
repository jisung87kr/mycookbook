<h4 class="mb-2">댓글</h4>
@forelse($comments as $comment)
    @include('comments.comment', [
        'comment' => $comment,
        'depth' => $loop->depth
    ])
@empty
    댓글이 없습니다.
@endforelse