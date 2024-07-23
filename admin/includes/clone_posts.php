<?php



foreach ($_POST['checkBoxArray'] as $post_id) {
    $query = "SELECT * FROM posts WHERE id = $post_id";
    $runQuery = mysqli_query($conn, $query);
    if(mysqli_num_rows($runQuery) == 1) {
        $post_info = mysqli_fetch_assoc($runQuery);
        $category_id = $post_info['category_id'];
        $title = $post_info['title'];
        $content = $post_info['content'];
        $author = $post_info['author'];
        $image = $post_info['image'];
        $tags = $post_info['tags'];
        $status = $post_info['status'];

    } else {
        continue;
    }

    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $new_image_name = uniqid() . "." . $ext;

    $old_image_path = '../images/' . $image; // مسار الصورة القديمة
    $new_image_path = '../images/' . $new_image_name; // مسار الصورة الجديدة

    if (file_exists($old_image_path)) {
        copy($old_image_path, $new_image_path); // نسخ الصورة
    }


    $query = "INSERT INTO posts(category_id, title, author, image, content, tags, status)
    VALUES('$category_id', '$title', '$author', '$new_image_name', '$content', '$tags', '$status')";
    $runQuery = mysqli_query($conn, $query);
    
}