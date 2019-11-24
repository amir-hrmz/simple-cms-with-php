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
    $showSinglePost = showSinglePost($_GET['id']);
}


        if ($showSinglePost) {
            foreach ($showSinglePost as $value) {


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
                        <div style="float: left">
                            <?php
                            $tags=explode(',' ,$value->tags);
                            foreach ($tags as $tag){
                                echo "<span class='tags'>$tag</span>";
                            }
                            ?>
                        </div>
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
<?php sendComment()?>

        <div class="sendComment"><!-- start sendComment-->
            <div class="commentHeader"><!-- start commentHeader-->
                <h1>ارسال نظر</h1>
            </div><!-- end commentHeader-->
            <div class="commentBody"><!-- start commentBody-->
                <form action="" method="post">
                    <input type="text" name="comment_author" class="textbox" placeholder="نویسنده">
                    <input type="text" name="comment_email" class="textbox" placeholder="ایمیل">
                    <textarea class="textbox" name="comment_body" style="height: 150px;resize: none;padding: 12px"
                              placeholder="نظر خود را بنویسد"></textarea>
                    <br>
                    <input type="submit" name="sendComment" class="btn btn-success" value="ارسال نظر">
                    <input type="reset" class="btn btn-error" value="انصراف">
                </form>
            </div><!-- end commentBody-->


        <div class="commentFooter">
            <?php
            $showQestion=showQestion($_GET['id']);
            if ($showQestion){

                foreach ($showQestion as $item){


            ?>
            <div class="answerCommnet">
                <div class="info">
                    <span class="comment_author"> <?php echo $item->author?> گفته : </span>
                    <span class="comment_date"> تاریخ  : <?php echo convertDate($item->comment_create_at)?> </span>
                    <div class="clear"></div>
                </div>
                <div class="">
                    <p class="commentQ">
                        <?php echo $item->body ?>
                    </p>
                </div>
                <?php
                    $showCommentReply=showCommentReply($item->id);
                if ($showCommentReply){
                foreach ($showCommentReply as $index){


                ?>
                <div class="divAdminReply">
                    <div class="info">
                        <span class="comment_author" style="color: blue">مدیر سایت گفته : </span>
                        <span class="comment_date"> تاریخ  : <?php echo convertDate($index->comment_create_at)?> </span>
                        <div class="clear"></div>
                    </div>
                    <p class="AdminReply">
                        <?php echo $index->body?>                    </p>
                </div>
                    <?php }}?>
            </div>
            <?php     }
            } ?>
        </div>
        <div class="clear"></div>
    </div><!-- end sendComment-->
        <div class="clear"></div>
    </div><!-- end body-->
    <div class="clear"></div>
</div><!-- end body-->
<div class="footer"><!-- end footer-->
    <p>Webamooz.Net</p>
</div><!-- end header-->

</body>
</html>