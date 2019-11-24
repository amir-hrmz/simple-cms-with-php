<?php
function addCategory()
{
    global $con;
    if (isset($_POST['insertCategory'])) {
        $sql = "insert into `categories` (`title`) VALUES (:title)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':title', $_POST['cat_title']);
        if ($stmt->execute()) {
            return $stmt;
        } else {
            return false;
        }
    }
}
function selectCategory()
{
    global $con;
    $sql = "SELECT * FROM `categories`";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount()) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}
function deleteCategory($id)
{
    global $con;
    if (isset($_GET['delete'])) {
        $sql = "delete from `categories` WHERE `id`=:id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount()) {
            return $stmt;
        } else {
            return false;
        }
    }
}
function editCategorySelect($id)
{
    global $con;
    if (isset($_GET['edit'])) {
        $sql = "select * from `categories` WHERE `id`=:id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
}
function updateCategory($id)
{
    global $con;
    $sql = "update `categories` set `title`=:title WHERE  `id`=:id";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':title', $_POST['cat_title']);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    if ($stmt->rowCount()) {
        return $stmt;

    } else {
        return false;
    }

}
function addPost()
{
    global $con;
    if (isset($_POST['insertPost'])) {
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['post_author'];
        $post_body = $_POST['post_body'];
        $post_tags = $_POST['post_tags'];
        $post_create_at = date('y-m-d');

        $file = $_FILES['post_img']['name'];
        $ext = explode('.', $file);
//         var_dump($ext);
        $fileExt = strtolower(end($ext));
//         var_dump($fileExt);
        $post_img = md5(microtime() . $file);
        $post_img .= "." . $fileExt;
//         var_dump($post_img);

        $error = $_FILES['post_img']['error'];
        $tmp_name = $_FILES['post_img']['tmp_name'];

        switch ($error) {
            case UPLOAD_ERR_OK;
                $valid = true;
                if (!in_array($fileExt, array('png', 'jpg', 'jepg', 'gif'))) {
                    $valid = false;
                    echo '<p>پسوند فایل انتخابی مجاز نیست</p>';
                }
                if ($error > 200000) {
                    $valid = false;
                    echo '<p class="alert alert-warning">عکس انتخاب شده بیش از حد بزرگ است</p>';
                }
                if ($valid) {
                    $valid = true;
                    echo '<p class="alert alert-success">عکس با موفقیت اپلودشد</p>';
                    move_uploaded_file($tmp_name, '../images/' . $post_img);
                    $sql = "INSERT INTO `posts` (`post_category_id`,`title`,`author`,`post_create_at`,`img`,`body`,`tags`)
                           VALUES (:post_category_id,:title,:author,:post_create_at,:img,:body,:tags)";
                    $stmt = $con->prepare($sql);
                    $stmt->bindParam(':post_category_id', $post_category_id);
                    $stmt->bindParam(':title', $post_title);
                    $stmt->bindParam(':author', $post_author);
                    $stmt->bindParam(':post_create_at', $post_create_at);
                    $stmt->bindParam(':img', $post_img);
                    $stmt->bindParam(':body', $post_body);
                    $stmt->bindParam(':tags', $post_tags);
                    $stmt->execute();
                    if ($stmt->rowCount()) {
                        echo "save";
                        return $stmt;

                    } else {
                        echo "nashod";
                        return false;
                    }
                }
                break;
            case UPLOAD_ERR_PARTIAL;
                echo '<p class="alert alert-warning">بخشی از عکس اپلود نشده است</p>';
                break;
            case  UPLOAD_ERR_NO_TMP_DIR;
                echo '<p>عکس کجاست؟</p>';
                break;
            default :
                echo '<p class="alert alert-error">خطا در درج</p>';
                break;
        }
    }
}
function selectAllPosts()
{
    global $count;
    global $con;

    if (!isset($_GET['page'])){
        $offset=$_GET['page']=1;
    }else{
        $offset=($_GET['page']-1)*4;
    }
    $sql = "SELECT * FROM `posts`";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $count=$stmt->rowCount()/4;

    $sql = "SELECT * FROM `posts` LIMIT {$offset},4";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount()) {
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } else {
        return false;
    }
}
function convertDate($value)
{
    $date = explode('-', $value);

    return gregorian_to_jalali($date[0], $date[1], $date[2], '/');
}
function showCategory($value)
{
    global $con;
    $sql = "SELECT * FROM `categories` WHERE `id`=:post_category_id";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':post_category_id', $value);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_OBJ);
    foreach ($row as $valueCategory) {
        return $valueCategory->title;
    }

}
function deletePost($id)
{
    global $con;
    if (isset($_GET['delete'])) {
        $sql = "DELETE FROM `posts` WHERE `id`=:id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if ($stmt->rowCount()) {
            return $stmt;
        } else {
            return false;
        }
    }
}
function selectPost($post_id)
{
    if (isset($post_id)) {
        global $con;
        $sql = "SELECT * FROM `posts` WHERE `id`=:post_id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
        if ($stmt->rowCount()) {
            return $stmt->fetch(PDO::FETCH_OBJ);

        } else {
            return false;
        }
    }
}
function updatePost($post_id){
    global $con;
    global $stmt;
    if (isset($_POST['editPost'])) {
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['post_author'];
        $post_body = $_POST['post_body'];
        $post_tags = $_POST['post_tags'];
        $post_create_at = date('y-m-d');
        $file = $_FILES['post_img']['name'];
        $ext = explode('.', $file);
        $fileExt = strtolower(end($ext));
        $post_img = md5(microtime() . $file);
        $post_img .= "." . $fileExt;
        $error = $_FILES['post_img']['error'];
        $tmp_name = $_FILES['post_img']['tmp_name'];
        switch ($error) {
            case UPLOAD_ERR_OK;
                $valid = true;
                if (!in_array($fileExt, array('png', 'jpg', 'jepg', 'gif'))) {
                    $valid = false;
                    echo '<p>پسوند فایل انتخابی مجاز نیست</p>';
                }
                if ($error > 200000) {
                    $valid = false;
                    echo '<p class="alert alert-warning">عکس انتخاب شده بیش از حد بزرگ است</p>';
                }
                if ($valid) {
                    $valid = true;
                    echo '<p class="alert alert-success">عکس با موفقیت اپلودشد</p>';
                    move_uploaded_file($tmp_name, '../images/' . $post_img);
                    $sql = "UPDATE `posts` set `post_category_id`=:post_category_id,`title`=:title,`author`=:author,
                    `post_create_at`=:post_create_at,`img`=:img,`body`=:body,`tags`=:tags WHERE `id`=:post_id";
                    $stmt = $con->prepare($sql);
                    $stmt->bindParam(':post_category_id', $post_category_id);
                    $stmt->bindParam(':title', $post_title);
                    $stmt->bindParam(':author', $post_author);
                    $stmt->bindParam(':post_create_at', $post_create_at);
                    $stmt->bindParam(':img', $post_img);
                    $stmt->bindParam(':body', $post_body);
                    $stmt->bindParam(':tags', $post_tags);
                    $stmt->bindParam(':post_id', $post_id);
                    $stmt->execute();
                    if ($stmt->rowCount()) {

                        return $stmt;

                    } else {
                        return false;
                    }
                }
                break;
            case UPLOAD_ERR_PARTIAL;
                echo '<p class="alert alert-warning">بخشی از عکس اپلود نشده است</p>';
                break;
            case  UPLOAD_ERR_NO_TMP_DIR;
                echo '<p>عکس کجاست؟</p>';
                break;
            default :
                echo '<p class="alert alert-error">خطا در درج</p>';
                break;
        }
    }
//return $stmt;
}
function searchPost($value){
    global $con;
    $sql="SELECT * FROM `posts` WHERE `tags` LIKE ?";
    $stmt=$con->prepare($sql);
    $stmt->bindValue(1,"%$value%");
    $stmt->execute();
    if ($stmt->rowCount()){
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }else{
        return false;
    }

}
function showSinglePost($item){
global $con;
    if (isset($item)){
        $sql = "SELECT * FROM `posts` WHERE `id`=:post_id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':post_id', $item);
        $stmt->execute();
        if ($stmt->rowCount()) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } else {
            return false;
        }
    }

}
function readMore($value){
    return mb_substr($value , 0 , 100 , 'utf-8').' ...';
}
function selectCategoryByPost($value){
global $con;
    if (isset($value)) {
        $sql = "SELECT * FROM `posts` WHERE `post_category_id`=:id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $value);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
function sendComment(){
    global $con;

    if (isset($_POST['sendComment'])){
    $comment_create_at=date('y-m-d');
        $sql="INSERT INTO `comments` (`comment_post_id`,`author`,`body`,`email`,`comment_create_at`)
        VALUES (:comment_post_id,:author,:body,:email,:comment_create_at)";
        $stmt=$con->prepare($sql);
        $stmt->bindParam(':comment_post_id',$_GET['id']);
        $stmt->bindParam(':author',$_POST['comment_author']);
        $stmt->bindParam(':body',$_POST['comment_body']);
        $stmt->bindParam(':email',$_POST['comment_email']);
        $stmt->bindParam(':comment_create_at',$comment_create_at);
        $stmt->execute();
        if ($stmt->rowCount()){
            return $stmt;
        }else{
            return false;
        }
    }
}
function selectComments(){
    global  $con;
    $sql="SELECT * FROM `comments`";
    $stmt=$con->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount()){
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }else{
        return false;
    }
}
function showPostForComment($value){
    global  $con;
    $sql="SELECT * FROM `posts` WHERE `id`=:comment_post_id";
    $stmt=$con->prepare($sql);
    $stmt->bindParam(':comment_post_id',$value);
    $stmt->execute();
    $row=$stmt->fetchAll(PDO::FETCH_OBJ);
    foreach ($row as $valuePost){
        return $valuePost->title;
    }
}
function commentConfirm($id){
    global  $con;
    $sql="UPDATE `comments` set `status`=? WHERE id=?";
    $stmt=$con->prepare($sql);
    $stmt->bindValue(1,1);
    $stmt->bindValue(2,$id);
    return $stmt->execute();
}
function commentReject($id){
    global  $con;
    $sql="UPDATE `comments` set `status`=? WHERE id=?";
    $stmt=$con->prepare($sql);
    $stmt->bindValue(1,0);
    $stmt->bindValue(2,$id);
    return $stmt->execute();
}
function selectOneComment($id)
{
    global $con;
    if (isset($id)) {
        $sql = "select * FROM `comments` WHERE `id`=:id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
function sendReplyComment($id,$comment_post_id){
    global $con;
    if (isset($_POST['sendReplyComment'])){
        $comment_create_at=date('y-m-d');
        $comment_author='مدیر سایت';
        $comment_email='admin@gmail.com';
        $status=1;
        $sql="INSERT INTO `comments` (`comment_post_id`,`author`,`body`,`status`,`email`,`comment_create_at`,`reply`)
        VALUES (:comment_post_id,:author,:body,:status,:email,:comment_create_at,:reply)";
        $stmt=$con->prepare($sql);
        $stmt->bindParam(':comment_post_id',$comment_post_id);
        $stmt->bindParam(':author',$comment_author);
        $stmt->bindParam(':body',$_POST['comment_body']);
        $stmt->bindParam(':status',$status);
        $stmt->bindParam(':email',$comment_email);
        $stmt->bindParam(':comment_create_at',$comment_create_at);
        $stmt->bindParam(':reply',$id);
        $stmt->execute();
        if ($stmt->rowCount()){
            return $stmt;
        }else{
            return false;
        }

    }

}
function deleteComment($id){
    global $con;
    $sql="delete from `comments` WHERE `id`=:id";
    $stmt=$con->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    if ($stmt->rowCount()){
        return $stmt;
    }else{
        return false;
    }
}
function editComment($id){
    global $con;
    if (isset($_POST['editComment'])){
        $comment_create_at=date('y-m-d');
        $sql="update `comments` set `body`=:comment_body,`comment_create_at`=:comment_create_at WHERE `id`=:id";
        $stmt=$con->prepare($sql);
        $stmt->bindParam(':comment_body',$_POST['comment_body']);
        $stmt->bindParam(':comment_create_at',$comment_create_at);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        if ($stmt->rowCount()){
            return $stmt;
        }else{
            return false;
        }

    }

}
function showQestion($comment_post_id){
    global $con;
    $sql="select * from `comments` WHERE `status`=? and `comment_post_id`=? and `reply`=?";
    $stmt=$con->prepare($sql);
    $stmt->bindValue(1,1);
    $stmt->bindValue(2,$comment_post_id);
    $stmt->bindValue(3,0);
    $stmt->execute();
    if ($stmt->rowCount()){
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }else{
        return false;
    }
}
function showCommentReply($id){
    global  $con;
    $sql="select * from `comments` WHERE `reply`=?";
    $stmt=$con->prepare($sql);
    $stmt->bindValue(1,$id);
    $stmt->execute();
    if ($stmt->rowCount()){
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }else{
        return false;
    }

}
function LoginCheck(){
    global $con;
    if (isset($_POST['Login'])){
        $sql="select * from `admin` WHERE `username`=? and `password`=?";
        $stmt=$con->prepare($sql);
        $stmt->bindValue(1,$_POST['admin_username']);
        $stmt->bindValue(2,md5($_POST['admin_password']));
        $stmt->execute();
        if ($stmt->rowCount()){
            $row= $stmt->fetch(PDO::FETCH_OBJ);
            $_SESSION['Admin']=['adminId'=>$row->id, 'username'=>$row->username];
            header('Location:admin/');
        }else{
            header('Location:login.php?Login=error');
        }

    }
}