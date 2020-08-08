<h4 class="mb-2">댓글</h4>
<div class="mb-2">
    @can('write-comment')
        @include('comments.create', ['comment' => null])
    @else
    <a href="{{ route('login') }}" class="btn btn-primary">로그인하세요</a>
    @endcan
</div>
@forelse($comments as $comment)
    @include('comments.comment', [
        'comment' => $comment,
        'depth' => $loop->depth
    ])
@empty
    댓글이 없습니다.
@endforelse
<script defer>
    window.addEventListener('load', function(){
        $(".create-comment").click(function(e){
            e.preventDefault();
            $(this).closest('.comment-card').find('.create-commnet-form').slideToggle();
        });

        $(".modify-comment").click(function(e){
            e.preventDefault();
            $(this).closest('.comment-card').find('.modify-comment-form').slideToggle();
        });

        $(".delete-comment").click(function(e){
            e.preventDefault();
            if(confirm('댓글을 삭제하시겠습니까?')){
                $(this).siblings('form').submit();
                // var id = $(this).data('id');
                // var url = $(this).attr('href');
                // $.ajax({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     },
                //     url : url,
                //     type: 'DELETE',
                //     dataType: 'json',
                //     data: {
                //         id : id
                //     },
                //     complete: function(data){
                //         console.log(data);
                //     }
                // });
            }
        })
    });
</script>