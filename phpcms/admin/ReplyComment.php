<?php require_once 'pages/header.php' ?>
<div class="body"><!-- start body-->
    <?php require_once 'pages/sidebar.php' ?>
    <?php
    $row = selectOneComment($_GET['id']);
    sendReplyComment($row->id,$row->comment_post_id)

    ?>
    <div class="content"> <!--- start Content --->
        <form action="" method="post">
            <input type="text" value="<?php echo $row->id ?>" class="textbox" name="id">
            <input disabled type="text" value="<?php echo $row->author ?>" class="textbox">
            <input disabled type="text" value="<?php echo showPostForComment($row->comment_post_id) ?>"
                   class="textbox">
            <input disabled type="text" value="<?php echo $row->email ?>" class="textbox">
            <textarea disabled class="textbox" style="height: 150px;padding: 12px;"><?php echo $row->body ?></textarea>
            <textarea name="comment_body" class="textbox" style="height: 170px;padding: 12px;"></textarea>
            <br>
            <input type="submit" class="btn btn-success" name="sendReplyComment" value="ارسال پاسخ">
            <input type="reset" class="btn btn-error" value="انصراف">
        </form>
    </div><!--- end Content --->
    <div class="clear"></div>
</div><!-- end body-->

<?php require_once 'pages/footer.php' ?>

