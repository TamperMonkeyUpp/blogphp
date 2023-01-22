<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    //like and unlike
        const URL = 'blog-details.php?id='+location.search.split("=")[1];
        $(document).ready(function(){
            // when the user clicks on like
            $('.like').on('click', function(){
                var postid = $(this).data('id');
                    $post = $(this);

                $.ajax({
                    url: URL,
                    type: 'post',
                    data: {
                        'liked': 1,
                        'postid': postid
                    },
                    success: function(response){
                        $post.parent().find('span.likes_count').text(response + " likes");
                        $post.addClass('hide');
                        $post.siblings().removeClass('hide');
                    }
                });
            });

            // when the user clicks on unlike
            $('.unlike').on('click', function(){
                var postid = $(this).data('id');
                $post = $(this);

                $.ajax({
                    url: URL,
                    type: 'post',
                    data: {
                        'unliked': 1,
                        'postid': postid
                    },
                    success: function(response){
                        $post.parent().find('span.likes_count').text(response + " likes");
                        $post.addClass('hide');
                        $post.siblings().removeClass('hide');
                    }
                });
            });
        });
        //like and unlike end

</script>