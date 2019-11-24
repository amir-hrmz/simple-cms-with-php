<?php require_once 'pages/header.php' ?>
<div class="body"><!-- start body-->
    <?php require_once 'pages/sidebar.php' ?>

    <div class="content"> <!--- start Content --->
        <?php
        if (isset($_GET['delete'])){
            $row = selectPost($_GET['delete']);
            $delete=deletePost($_GET['delete']);
            if($delete){
                $post_img = "../images/".$row->img;
                unlink($post_img);
                header("Location:posts.php?success=true");
            }else{
                header("Location:posts.php?error=true");

            }
        }
        ?>
       <p class=" alert alert-info">  لیست مطالب  </p>
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
                <th>عنوان</th>
                <th>دسته بندی</th>
                <th>نویسنده</th>
                <th>تاریخ</th>
                <th>تصویر</th>
                <th>تگ ها</th>
                <th> عملیات</th>
            </tr>
            </thead>
            <tbody>
            <?php $selectAllPosts=selectAllPosts();
            if($selectAllPosts) {


                foreach ($selectAllPosts as $index => $value) {


                    ?>
                    <tr>
                        <td><?php echo $index + 1 ?></td>
                        <td><?php echo $value->title ?> </td>
                        <td><?php echo showCategory($value->post_category_id );?></td>
                        <td><?php echo $value->author ?> </td>
                        <td><?php

                            echo convertDate($value->post_create_at);
                            ?>
                        </td>
                        <td><img width="170" height="120" src="../images/<?php echo $value->img ?>" alt=""></td>
                        <td><?php echo $value->tags ?> </td>
                        <td>
                            <a class="btn btn-error" href="posts.php?delete=<?php echo $value->id; ?>">حذف</a>
                            <a class="btn btn-warning" href="editpost.php?edit=<?php echo $value->id; ?>">ویرایش</a>
                        </td>
                    </tr>
                <?php }
            }else {

            ?>
              <p class="alert alert-warning">مطلبی وجود ندارد</p>

            <?php  } ?>
            </tbody>
        </table>
    </div><!--- end Content --->
    <div class="clear"></div>
</div><!-- end body-->


