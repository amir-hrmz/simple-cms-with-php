<?php
require_once 'includes/init.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>وبلاگ من</title>
</head>
<body>
<div class="header"> <!-- start header-->
    <div class="contanier" ><!-- start contanier-->
        <ul class="menu">
            <?php
            $showCat = selectCategory();
            foreach ($showCat as $value) {
                echo "<li><a href=>{$value['title']}</a></li>";
            }
            ?>
            <li><a href="admin">ورود مدیریت</a></li>
            <li class="logo"><a href="./"><img src="images/weblogo.png"></a></li>
        </ul>
        <div class="clear"></div>
    </div><!-- end contanier-->

    <div class="HeaderPic"><!-- end HeaderPic-->
        <img src="images/bgtop.jpg">

        <form action="search.php" method="post">
            <div class="search"><!-- end search-->
                <input type="text" name="search" class="inputSearch" placeholder="جستجو کنید ">
                <button class="searchBtn" name="btnSearach">جستجو</button>
                <div class="clear"></div>
            </div><!-- end search-->
        </form>
        <div class="clear"></div>
    </div><!-- end HeaderPic-->

    <div class="clear"></div>
</div><!-- end header-->
<div class="body"><!-- start body-->
    <div class="contanier " style="display: flex; flex-direction: column;"><!-- start contanier-->
        <?php
if (isset($_GET['id'])){
    $selectCategoryByPost = selectCategoryByPost($_GET['id']);
}


        if ($selectCategoryByPost) {
            foreach ($selectCategoryByPost as $value) {


                ?>

                <div class="post" style="width: 70%; align-self: center;"><!-- start post-->
                    <div class="postHeader"><!-- start postHeader-->
                        <h1 class="postTitle"><a
                                href="post.php?id=<?php echo $value->id ?>"><?php echo $value->title ?></a></h1>
                        <span> تاریخ انتشار : <?php echo convertDate($value->post_create_at); ?> </span>
                        <div class="clear"></div>
                    </div><!-- end postHeader-->
                    <div class="postBody"><!-- start postBody-->
                        <div class="postPic" style="height: auto"><!-- start postPic-->
                            <img src="images/<?php echo $value->img ?>">
                        </div><!-- end postPic-->
                        <div class="postDesc"><!-- start postHeader-->
                            <?php echo $value->body ?>
                        </div><!-- end postDesc-->
                        <div class="clear"></div>
                    </div><!-- end postBody-->
                    <div class="postFooter"><!-- start postFooter-->
                        <span>نویسنده مطلب : <?php echo $value->author ?> </span>
                        <div class="clear"></div>
                    </div><!-- end postHeader-->

                    <div class="clear"></div>
                </div><!-- end post-->

            <?php }
        } else {
            echo '<p class="alert alert-info">مطلبی وجود ندارد</p>';
        }


        ?>
        <div class="clear"></div>
    </div><!-- end body-->
    <div class="clear"></div>
</div><!-- end body-->
<div class="footer"><!-- end footer-->
    <p>Webamooz.Net</p>
</div><!-- end header-->

</body>
</html>