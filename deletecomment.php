<?php
require 'functions.php';
//deletes given comment by its id
$id_comment ='';
if(isset($_GET['id'])){
$id_comment = (int)$_GET['id'];
  }
$dbh = connect_to_db();
$task = deleteComment($id_comment, $dbh);
 ?>
