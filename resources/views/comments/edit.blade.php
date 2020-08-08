<form action="{{ route('comments.update', $comment) }}" method="POST" class="modify-comment-form mt-2" style="display: none;">
    @csrf
    @method('PUT')
    @if(isset($comment))
    <input type="hidden" name="comment_parent" value="{{ $comment->id }}">
    @endif
    <div class="form-group">
        <textarea class="form-control mb-2 @error('post_comment') is-invalid @enderror"
        name="post_comment"
        id="post-comment"
        rows="3">{{ old('post_comment', $comment->comment) }}</textarea>
        @error('post_comment')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="text-right">
        <input type="submit" value="저장" class="btn btn-secondary">
        </div>
    </div>
</form>