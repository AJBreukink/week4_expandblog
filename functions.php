<?php
require 'dbconnect.php';


function fetchNewsCategories( $article_id, $conn )
{
  $request = $conn->prepare(" SELECT c.name FROM blogarticles_categories ac
    JOIN blogarticles a ON ac.article_id = a.id
    JOIN categories c ON ac.category_id = c.id
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

?>
