<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comment[]|\Cake\Collection\CollectionInterface $comments
 */
?>
<div>
    <table cellpadding="0" cellspacing="0">
        <tbody>
            <?php foreach ($comments as $comment): ?>
            <tr id="<?php echo 'comment-row-'.$comment->id;?>">
                <td><?= h($comment->comment) ?></td>
                <td><?= h($comment->created) ?></td>
                <td><button class="delete-comment" id="<?php echo 'delete-'.$comment->id;?>">Delete</button></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    $(".delete-comment").on('click', function(){
        if(confirm('Are you sure you want to delete the comment?')){
            var commentId = $(this).attr('id');
            commentId = commentId.replace('delete-', '');
            $.ajax({
                url: baseUrl+'comments/ajax-delete/'+commentId,
                type: 'POST',
                data: {id: commentId},
                success: function(response){
                    var parsed = $.parseJSON(response);
                    if(parsed.success){
                        $("#comment-row-"+commentId).fadeOut(400);
                    }else{
                        alert(parsed.error_message);
                    }
                }
            });
        }
    });
</script>