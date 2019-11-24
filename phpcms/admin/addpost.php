<?php require_once 'pages/header.php' ?>
<div class="body"><!-- start body-->
    <?php require_once 'pages/sidebar.php' ?>

    <div class="content"> <!--- start Content --->
        <?php
        addPost();
        ?>
        <form action="addpost.php" method="post" enctype="multipart/form-data">
            <input type="text" class="textbox" name="post_title" placeholder="عنوان مطلب">
            <select name="post_category_id" class="textbox">
                <?php
                $selectCategory= selectCategory();
                foreach ($selectCategory as $value){
                    echo "<option value='".$value['id']."'>{$value['title']}</option>";
                }
                ?>

            </select>
            <input type="text" name="post_author" required="required" class="textbox" placeholder="نویسنده مطلب">
<!--            <style>-->
<!--                .selectPic {-->
<!--                    background: #45a9ff;-->
<!--                    width: 20%;-->
<!--                    margin-bottom: 5px;-->
<!--                    height: 38px;-->
<!--                    border-radius: 2px;-->
<!--                    padding: 5px 20px;-->
<!--                    color: #fff;-->
<!--                    font-size: 17px;-->
<!--                    cursor: pointer;-->
<!--                }-->
<!---->
<!--                .selectPic input {-->
<!--                    opacity: 0;-->
<!--                }-->
<!--            </style>-->

                <input type="file" name="post_img" required="required" class="textbox">

            <textarea name="post_body" required="required" class="textbox" style="height: 230px;padding: 15px;"
                      placeholder="توضیحات مطلب"></textarea>
            <input type="text" required="required" name="post_tags" class="textbox" placeholder="برچسب ها">
            <br>
            <input type="submit" class="btn btn-success" name="insertPost" value="درج مطلب">
            <input type="reset" class="btn btn-error" value="انصراف">
        </form>

    </div><!--- end Content --->
    <div class="clear"></div>
</div><!-- end body-->

<?php require_once 'pages/footer.php' ?>

