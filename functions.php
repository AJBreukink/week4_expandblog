<?php
require 'dbconnect.php';

//retrieve all articles' id number, title, description and date posted on,
//newest to oldest (for index page)
function fetchNews( $conn )
{
  $request = $conn->prepare(" SELECT id, title, description, postdate
    FROM blogarticles
    ORDER BY id DESC ");
  return $request->execute() ? $request->fetchAll() : false;
}

//retrieve category/categories attached to given article by id
function fetchNewsCategories( $article_id, $conn )
{
  $request = $conn->prepare(" SELECT c.name FROM blogarticles_categories ac
    JOIN blogarticles a ON ac.article_id = a.id
    JOIN categories c ON ac.category_id = c.id
    WHERE a.id = $article_id ");
  return $request->execute() ? $request->fetchAll() : false;
}

//retrieve full article text for given article by id (for readpost page)
function getAnArticle( $id_article, $conn )
{
  $request =  $conn->prepare(" SELECT id, title, content, postdate
    FROM blogarticles WHERE id = ? ");
  return $request->execute(array($id_article)) ? $request->fetchAll() : false;
}

//retrieve some other articles than the one full shown (on readpost page)
function getOtherArticles( $differ_id, $conn )
{
  $request =  $conn->prepare(" SELECT id, title, description, content, postdate
    FROM blogarticles  WHERE id != ? ORDER BY id DESC ");
  return $request->execute(array($differ_id)) ? $request->fetchAll() : false;
}

//retrieve all articles belonging to given category by id
//(for categories page / category filter)
function getCategories( $category_id, $conn )
{
  $request =  $conn->prepare(" SELECT a.id, a.title, a.description, a.postdate
    FROM blogarticles_categories ac
    JOIN blogarticles a ON ac.article_id = a.id
    JOIN categories c ON ac.category_id = c.id
    WHERE c.id = ?
    ORDER BY a.id DESC");
  return $request->execute(array($category_id)) ? $request->fetchAll() : false;
}

//get comments belonging to give article by id
function fetchComments( $article_id, $conn )
{
  $request = $conn->prepare(" SELECT cm.comment FROM blogarticles_comments acm
    JOIN blogarticles a ON acm.article_id = a.id
    JOIN comments cm ON acm.comment_id = cm.id
    WHERE a.id = $article_id ");
  return $request->execute() ? $request->fetchAll() : false;
}

?>
