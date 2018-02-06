<?php
require 'functions.php';
?>

<html>
<head>
  <meta charset="utf-8">
  <title>Add Post</title>
  <link rel="stylesheet" type="text/css" href="style.css">

  <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  <script>
          tinymce.init({
              content_css : "inputstyle.css",
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });

  </script>

</head>
<body>

<div id="container">

  <div class="welcome">
    <h1>Write a new article</h1>
    <a href="index.php">Back to home page</a>
  </div>

    <?php

    //if form has been submitted process it
    if(isset($_POST['submit'])){

        $_POST = array_map( 'stripslashes', $_POST );

        //collect form data
        extract($_POST);

        $postdate = date('Y-m-d H:i:s');

        //very basic validation
        if($postTitle ==''){
            $error[] = 'Please enter the title.';
        }
        /*
        if($postCat ==''){
            $error[] = 'Please enter the category.';
        }
        */
        if($postDesc ==''){
            $error[] = 'Please enter the description.';
        }

        if($postCont ==''){
            $error[] = 'Please enter the content.';
        }

        if(!isset($error)){

            try {

                //insert into database
                $pdo = connect_to_db();
                $sendPost = "INSERT INTO blogarticles(title, description, content, postdate) " .
                            "VALUES ('$postTitle', '$postDesc', '$postCont', '$postdate')";
                $pdo->exec($sendPost);

                //redirect to index page
                header('Location: index.php?action=added');
                exit;

            } catch(PDOException $e) {
                echo '<p class="error">'.$e->getMessage().'</p>';
            }

        }

    }

    //check for any errors
    if(isset($error)){
        foreach($error as $error){
            echo '<p class="error">'.$error.'</p>';
        }
    }
    ?>
    <div class="news-box">
      <form action='' method='post'>

        <p><label>Title</label><br />
        <input type='text' name='postTitle' value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'></p>

        <p><label>Category</label><br/>
          <select name="postCat" >
          <option value="1">Programming</option>
          <option value="2">In the News</option>
          <option value="3">Daily Life</option>
          <option value="4">Interesting</option>
          <?php if(isset($error)){ echo $_POST['postCat'];}?>
          </select>
        </p>
        <!--<input type='text' name='postCat' value='</?php if(isset($error)){ echo $_POST['postCat'];}?>'></p> -->

        <p><label>Description</label><br />
        <textarea name='postDesc'><?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea></p>

        <p><label>Content</label><br />
        <textarea name='postCont'><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea></p>

        <p><input type='submit' name='submit' value='Post'></p>

      </form>
    </div>
  </div>

</body>
</html>
