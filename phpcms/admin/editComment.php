<?php require_once 'pages/header.php' ?>
<div class="body"><!-- start body-->
    <?php require_once 'pages/sidebar.php' ?>
    <?php
    $row = selectOneComment($_GET['edit']);

    if (isset($_POST['editComment'])){
        $editComment=editComment($row->id);
        if ($editComment){

                $message = '<p class="alert alert-success">ویرایش با موفقیت انجام شد</p>';
                header("refresh:1, url =comments.php");
            } else {
                $message = '<p class="alert alert-error">ویرایش با خطا مواجه شد</p>';
            }

    }
    ?>
    <div class="content"> <!--- start Content --->
        <?php if (isset($message)) echo $message; ?>
        <form action="" method="post">
            <input type="text" value="<?php echo $row->id ?>" class="textbox" name="id">
            <input disabled type="text" value="<?php echo $row->author ?>" class="textbox">
            <input disabled type="text" value="<?php echo showPostForComment($row->comment_post_id) ?>"
                   class="textbox">
            <input disabled type="text" value="<?php echo $row->email ?>" class="textbox">
            <textarea  name="comment_body" class="textbox" style="height: 150px;padding: 12px;"><?php echo $row->body ?></textarea>

            <br>
            <input type="submit" class="btn btn-success" name="editComment" value="ویرایش">
            <input type="reset" class="btn btn-error" value="انصراف">
        </form>


    </div><!--- end Content --->
    <div class="clear"></div>
</div><!-- end body-->

<?php require_once 'pages/footer.php' ?>

