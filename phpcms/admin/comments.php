<?php require_once 'pages/header.php' ?>
<div class="body"><!-- start body-->
    <?php require_once 'pages/sidebar.php';
    if (isset($_GET['delete'])){
        $deleteComment=deleteComment($_GET['delete']);
        if ($deleteComment){
            header('location:comments.php?success=ok');
            die();
        } else {
            header('location:comments.php?error=ok');

        }
    }
    ?>


    <div class="content"> <!--- start Content --->
        <?php
        if (isset($_GET['success'])) {
            echo '<p class="alert alert-success">حذف با موفقیت انجام شد</p>';
        } elseif (isset($_GET['error'])) {
            echo '<p class="alert alert-error">حذف با  خطا مواجه شد</p>';
        }
        ?>
        <table>
            <thead>
            <tr>
                <th>شناسه</th>
                <th>مطلب </th>
                <th>نویسنده</th>
                <th>ایمیل</th>
                <th>متن کامنت</th>
                <th>تاریخ </th>
                <th>وضعیت </th>
                <th width="10%">پاسخ دادن </th>
                <th width="13%">عملیات </th>
            </tr>
            </thead>
            <tbody>
            <?php
                $selectComments= selectComments();

            if ($selectComments) {
                foreach ($selectComments as $index=> $value) {
                    ?>

                    <tr>
                        <td><?php echo $index+1 ?></td>
                        <td><?php echo showPostForComment($value->comment_post_id);?></td>
                        <td><?php echo $value->author?></td>
                        <td><?php echo $value->email?></td>
                        <td><?php echo $value->body?></td>
                        <td><?php echo convertDate($value->comment_create_at) ?></td>
                        <?php
                            if (isset($_GET['confirm'])){
                                commentConfirm($_GET['confirm']);
                                header('Location:comments.php');
                            }elseif(isset($_GET['reject'])){
                                commentReject($_GET['reject']);
                                header('Location:comments.php');
                            }
                        ?>
                        <td>
                            <?php
                            if (($value->status) == 0) {
                                ?>
                                <a class="status" href="comments.php?confirm=<?php echo $value->id ?>">تایید نظر</a>
                                <?php
                            } else {
                                ?>
                                <a class="delete" style="width: 75px;" href="comments.php?reject=<?php echo $value->id ?>">رد نظر</a>
                            <?php }
                            ?>
                        </td>
                        <td>
                            <?php
                                if (!$value->reply) {
                                    ?>
                                    <a class="answer" href="ReplyComment.php?id=<?php echo $value->id ?>">پاسخ دادن</a>

                                    <?php
                                }else{
                                    echo 'پاسخ داده شده';
                                }
                                    ?>
                        </td>
                        <td>
                            <a class="delete" href="comments.php?delete=<?php echo $value->id?>">حذف</a>
                            <a class="edit" href="editComment.php?edit=<?php echo $value->id ?>">ویرایش</a>
                        </td>
                    </tr>

                <?php }
            }else{

            ?>
<p class="alert alert-info">کامنتی وجود ندارد</p>
            <?php } ?>
            </tbody>
        </table>
    </div><!--- end Content --->
    <div class="clear"></div>
</div><!-- end body-->

<?php require_once 'pages/footer.php' ?>

