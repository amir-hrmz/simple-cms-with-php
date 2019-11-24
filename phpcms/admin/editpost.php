<?php require_once 'pages/header.php' ?>
<div class="body"><!-- start body-->
    <?php require_once 'pages/sidebar.php' ?>

    <div class="content"> <!--- start Content --->
        <?php

        $row = selectPost($_GET['edit']);


        if (isset($_GET['edit']) && isset($_POST['post_id'])) {
            $updatePost = updatePost($_POST['post_id']);
            if ($updatePost) {
                $post_img = "../images/" . $row->img;
                unlink($post_img);
                $message = '<p class="alert alert-success">ویرایش با موفقیت انجام شد</p>';
                header("refresh:1, url = Posts.php");
            } else {
                $message = '<p class="alert alert-error">ویرایش با خطا مواجه شد</p>';

            }
        }
        ?>
        <form action="#" method="post" enctype="multipart/form-data">
            <input type="text" class="textbox" name="post_title" value="<?php echo $row->title ?>" ">
            <select name="post_category_id" class="textbox">
                <?php
                $selectAllCategory = selectCategory();
                foreach ($selectAllCategory as $value) {
                    ?>
                    <option value="<?php echo $value['id'] ?>" <?php if ($row->post_category_id == $value['id']) {
                        echo 'selected';
                    } ?>>
                        <?php echo $value['title'] ?>
                    </option>
                <?php } ?>
            </select>
            <input type="text" name="post_author" required="required" class="textbox"
                   value="<?php echo $row->author ?>">


            <input type="file" name="post_img" required="required" class="textbox">
            <div><img width="170px" height="110px" src="../images/<?php echo $row->img ?>" alt=""></div>

            <textarea name="post_body" required="required" class="textbox"
                      style="height: 230px;padding: 15px;"><?php echo $row->body ?> </textarea>
            <input type="text" required="required" name="post_tags" class="textbox" value="<?php echo $row->tags ?>">
            <br>
            <input type="text" name="post_id" class="textbox" value="<?php echo $row->id ?>">
            <input type="submit" class="btn btn-success" name="editPost" value="ویرایش">
            <input type="reset" class="btn btn-error" value="انصراف">
        </form>

    </div><!--- end Content --->
    <div class="clear"></div>
</div><!-- end body-->

<?php require_once 'pages/footer.php' ?>

