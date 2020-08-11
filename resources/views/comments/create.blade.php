<form action="{{ route('posts.comments.store', $post) }}" method="POST" class="create-commnet-form" @if($comment !== null) style='display: none;' @endif >
    @csrf
    @if(isset($comment))
    <input type="hidden" name="comment_parent" value="{{ $comment->id }}">
    @endif
    <div class="form-group">
        <textarea class="form-control mb-2 @error('post_comment') is-invalid @enderror" name="post_comment" id="post-comment" rows="3"></textarea>
        @error('post_comment')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="text-right">
        <input type="submit" value="저장" class="btn btn-secondary">
        </div>
    </div>
</form>