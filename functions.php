<?php
require 'dbconnect.php';


function fetchNewsCategories( $article_id, $conn )
{
  $request = $conn->prepare(" SELECT c.name FROM blogarticles_categories ac
    JOIN blogarticles a
    ON ac.article_id = a.id JOIN categories c
    ON ac.category_id = c.id
    WHERE a.id = $article_id ");
  return $request->execute() ? $request->fetchAll() : false;
}

function fetchNews( $conn )
{
  $request = $conn->prepare(" SELECT id, title, description, postdate
    FROM blogarticles
    ORDER BY id DESC ");
  return $request->execute() ? $request->fetchAll() : false;
}

function getAnArticle( $id_article, $conn )
{
  $request =  $conn->prepare(" SELECT id, title, content, postdate
    FROM blogarticles WHERE id = ? ");
  return $request->execute(array($id_article)) ? $request->fetchAll() : false;
}

function getOtherArticles( $differ_id, $conn )
{
  $request =  $conn->prepare(" SELECT id, title, description, content, postdate
    FROM blogarticles  WHERE id != ? ORDER BY id DESC ");
  return $request->execute(array($differ_id)) ? $request->fetchAll() : false;
}


function getCategories( $id_category, $conn )
{
  $request =  $conn->prepare(" SELECT id, title, description, content, postdate
    FROM blogarticles WHERE category_id = ? ORDER BY id DESC");
  return $request->execute(array($id_category)) ? $request->fetchAll() : false;
}

?>
