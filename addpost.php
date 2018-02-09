<?php
require 'functions.php';
?>

<html>
<head>
  <meta charset="utf-8">
  <title>Add Post</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <!--<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script> -->
  <script>
          /*tinymce.init({
              content_css : "inputstyle.css",
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
          */

    shortcuts = {
        "cg" : "CodeGorilla",
        "js" : "JavaScript",
        "aj" : "Arend-Jan",
        "grn" : "Groningen",
        "jdb" : "Jorik de Boer",
        "jvd" : "Julia van Drunen",
        "evd" : "Eelke van Dijk"
    }

    window.onload = function() {
        var ta = document.getElementById("textinput");
        var timer = 0;
        var re = new RegExp("\\b(" + Object.keys(shortcuts).join("|") + ")\\b", "g");

        update = function() {
            ta.value = ta.value.replace(re, function($0, $1) {
                return shortcuts[$1.toLowerCase()];
            });
        }

        ta.onkeydown = function() {
            clearTimeout(timer);
            timer = setTimeout(update, 200);

        }

    }
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
      /*
        $_POST = array_map( 'stripslashes', $_POST );

        //collect form data
        extract($_POST);
        */
        $postTitle = $_POST['postTitle'];

        $postDesc = $_POST['postDesc'];

        $postCont = $_POST['postCont'];

        $postCat = $_POST['postCat'];

        $postdate = date('Y-m-d H:i:s');

        $enableComments = $_POST['commentsYN'];
        //echo '<p class="error">'.$enableComments.'</p>';

        //validation of sorts
        if($postTitle ==''){
            $error[] = 'Please enter the title.';
        }

        if($postCat ==''){
            $error[] = 'Please enter the category.';
        }

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

                  $sendPost =
                    "INSERT INTO blogarticles
                    (title, description, content, postdate, enablecomments) " .
                    "VALUES ('$postTitle', '$postDesc', '$postCont', '$postdate', '$enableComments')";
                  $pdo->exec($sendPost);

                $lastID = $pdo->lastInsertId();
                //echo '<p class="error">lastid='.$last_id.'</p>';

                //send selected categories and attach to article by id
                foreach ($postCat as $cat) {
                  $intCat = (int)$cat;
                  $sendCat =  "INSERT INTO blogarticles_categories (article_id, category_id)" .
                              "VALUES ('$lastID', '$intCat')";
                              $pdo->exec($sendCat);
                  }
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
        <input type='text' name='postTitle'
          value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'></p>

        <p><label>Category</label><br/>
        <input type="checkbox" name="postCat[]" value="1"> Programming<br>
        <input type="checkbox" name="postCat[]" value="2" > In the News<br>
        <input type="checkbox" name="postCat[]" value="3"> Daily Life<br>
        <input type="checkbox" name="postCat[]" value="4" checked> Interesting<br>
        <input type="checkbox" name="postCat[]" value="5"> History<br>
        <input type="checkbox" name="postCat[]" value="6" > Technology<br>
        </p>

        <p><label>Description</label><br />
        <textarea id='textinput' name='postDesc' cols='100' rows='10'>
          <?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea></p>

        <p><label>Content</label><br />
        <textarea id='textinput' name='postCont' cols='100' rows='20'>
          <?php if(isset($error)){ echo $_POST['postCont'];}?></textarea></p>

        <p><label>Allow comments? </label>
        <input type="radio" name="commentsYN" value="1" checked> Yes
        <input type="radio" name="commentsYN" value="0"> No </p>

        <p><input type='submit' name='submit' value='Post'></p>

      </form>
    </div>
  </div>

</body>
</html>
