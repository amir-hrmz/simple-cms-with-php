<?php require_once 'pages/header.php' ?>
<div class="body"><!-- start body-->
    <?php require_once 'pages/sidebar.php' ?>
<?php
$row=editCategorySelect($_GET['edit']);
if (isset($_GET['edit']) && isset($_POST['cat_id']) ){
    $updateCategory=updateCategory($_POST['cat_id']);
    if ($updateCategory) {
        $message = '<p class="alert alert-success">ویرایش با موفقیت انجام شد</p>';
        header("refresh:1, url =categories.php");
    } else {
        $message = '<p class="alert alert-error">ویرایش با خطا مواجه شد</p>';
    }
}
?>
    <div class="content"> <!--- start Content --->
        <form action="#" method="post">
            <input type="text" class="textbox" name="cat_title" value="<?php echo $row['title']?>" ">
            <input type="text" class="textbox" name="cat_id" value="<?php echo $row['id']?>" ">
            <br>
            <input type="submit" class="btn btn-success" name="editCategory" value="ویرایش دسته بندی">
            <input type="reset" class="btn btn-error"  value="انصراف">
        </form>

        <?php if (isset($message)) echo $message; ?>
    </div><!--- end Content --->
    <div class="clear"></div>
</div><!-- end body-->

<?php require_once 'pages/footer.php' ?>

