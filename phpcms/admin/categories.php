<?php require_once 'pages/header.php' ?>
<div class="body"><!-- start body-->
    <?php require_once 'pages/sidebar.php' ?>
<?php
addCategory();

if (isset($_GET['delete'])){
    $deleteCategory = deleteCategory($_GET['delete']);
    if ($deleteCategory) {
        header('location:categories.php?success=ok');
        die();
    } else {
        header('location:categories.php?error=ok');
    }
}
?>
    <div class="content"> <!--- start Content --->
        <form action="#" method="post">
            <input type="text" class="textbox" name="cat_title" placeholder="نام دسته بندی">
            <br>
            <input type="submit" class="btn btn-success" name="insertCategory" value="درج دسته بندی">
            <input type="reset" class="btn btn-error"  value="انصراف">
        </form>
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
                <th>نام دسته بندی</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $selectCategory = selectCategory();
            if ($selectCategory) {
                foreach ($selectCategory as $index => $value) {
                    ?>

                    <tr>
                        <td><?php echo $index + 1 ?></td>
                        <td><?php echo $value['title'] ?></td>
                        <td>
                            <a class="btn btn-error" href="categories.php?delete=<?php echo $value['id'] ;?>">حذف</a>
                            <a class="btn btn-warning" href="editcategories.php?edit=<?php echo $value['id']?>">ویرایش</a>
                        </td>
                    </tr>
                    <?php
                }
            }else{

                ?>
                <td class="alert alert-info">دسته ای وجود ندارد</td>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div><!--- end Content --->
    <div class="clear"></div>
</div><!-- end body-->

<?php require_once 'pages/footer.php' ?>

