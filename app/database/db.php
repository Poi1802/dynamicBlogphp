<?php
require __DIR__ . '/connect.php';

session_start();

function dump($val)
{
  echo '<pre>';
  print_r($val);
  echo '</pre>';
  exit();
}
// Проверка на ошибки
function dbCheckErr($query)
{
  $errInfo = $query->errorInfo();
  if ($errInfo[0] !== PDO::ERR_NONE) {
    echo $errInfo[2];
    exit();
  }
  return true;
}
// запрос на получение данных с таблицы
function selectAll($table, $params = [])
{
  global $pdo;
  $sql = "SELECT * FROM $table";

  if (!empty($params)) {
    $i = 0;
    foreach ($params as $key => $value) {
      if (!is_numeric($value)) {
        $value = "'" . $value . "'";
      }
      if ($i === 0) {
        $sql = $sql . " WHERE $key=$value";
      } else {
        $sql = $sql . " AND $key=$value";
      }
      $i++;
    }
  }

  $query = $pdo->prepare($sql);
  $query->execute();

  dbCheckErr($query);

  return $query->fetchAll();
}
// запрос на получение строки с таблицы
function selectOne($table, $params = [])
{
  global $pdo;
  $sql = "SELECT * FROM $table";

  if (!empty($params)) {
    $i = 0;
    foreach ($params as $key => $value) {
      if (!is_numeric($value)) {
        $value = "'" . $value . "'";
      }
      if ($i === 0) {
        $sql = $sql . " WHERE $key=$value";
      } else {
        $sql = $sql . " AND $key=$value";
      }
      $i++;
    }
  }
  // echo $sql;
  $query = $pdo->prepare($sql);
  $query->execute();

  dbCheckErr($query);

  return $query->fetch();
}
// функция добавления данных в бд
function insert($table, $params)
{
  global $pdo;
  $col = '';
  $mask = '';

  $i = 0;
  foreach ($params as $key => $val) {
    if ($i === 0) {
      $col .= $key;
      $mask .= ':' . $key;
    } else {
      $col .= ', ' . $key;
      $mask .= ', ' . ':' . $key;
    }
    $i++;
  }

  $sql = "INSERT INTO $table($col) VALUES ($mask)";
  $query = $pdo->prepare($sql);
  $query->execute($params);
  dbCheckErr($query);

  return $pdo->lastInsertId();
}
// функция обновления данных в бд
function update($table, $id, array $params)
{
  global $pdo;
  $row = '';

  $i = 0;
  foreach ($params as $key => $val) {
    if ($i === 0) {
      $row .= "$key = :$key";
    } else {
      $row .= ", $key = :$key";
    }
    $i++;
  }

  $sql = "UPDATE $table SET $row WHERE id=$id";
  $query = $pdo->prepare($sql);
  $query->execute($params);
  return dbCheckErr($query);
}
// функция удаления данных из бд
function deleteRow(string $table, int $id, $col = 'id'): void
{
  global $pdo;
  $sql = "DELETE FROM $table WHERE $col=$id";
  $pdo->query($sql);
}

// $data = selectAll('users');

// dump($data);

// Вытягиваем пользователя поста
function selectPostsOfUsers($tableUsers, $tablePosts)
{
  global $pdo;
  $sql = "SELECT t1.username, t2.* FROM $tableUsers AS t1 JOIN $tablePosts as t2 ON t1.id = t2.id_user";
  $query = $pdo->prepare($sql);
  $query->execute();

  dbCheckErr($query);

  return $query->fetchAll();
}

function selectPostsOfUsersPubl($tableUsers, $tablePosts, $limit, $offset, $category = null)
{
  global $pdo;
  $sql = $category
    ? "SELECT t1.username, t2.* 
      FROM $tableUsers AS t1 
      JOIN $tablePosts as t2 ON t1.id = t2.id_user 
      WHERE t2.status = 1 AND t2.id_topic = $category ORDER BY t2.created_date DESC LIMIT $limit OFFSET $offset"
    : "SELECT t1.username, t2.* 
      FROM $tableUsers AS t1 
      JOIN $tablePosts as t2 ON t1.id = t2.id_user 
      WHERE t2.status = 1 ORDER BY t2.created_date DESC LIMIT $offset, $limit";
  $query = $pdo->prepare($sql);
  $query->execute();

  dbCheckErr($query);

  return $query->fetchAll();
}

function countOfPublPosts($table, $category = null)
{
  global $pdo;
  $sql = $category
    ? "SELECT COUNT(*) FROM $table WHERE id_topic = $category AND status = 1"
    : "SELECT COUNT(*) FROM $table WHERE status = 1";
  $query = $pdo->prepare($sql);
  $query->execute();
  $col = $query->fetchColumn();

  dbCheckErr($query);
  return $col;
}

function selectPostsOfUser($tableUsers, $tablePosts, $postId)
{
  global $pdo;
  $sql = "SELECT t1.username, t2.* FROM $tableUsers AS t1 JOIN $tablePosts as t2 ON t1.id = t2.id_user WHERE t2.id = $postId";
  $query = $pdo->prepare($sql);
  $query->execute();

  dbCheckErr($query);

  return $query->fetch();
}

function selectPostsSearched($tableUsers, $tablePosts, $searchText, $limit, $offset, $category = null)
{
  global $pdo;
  $searchText = trim(strip_tags(stripslashes(htmlspecialchars($searchText))));
  $sql = $category
    ? "SELECT t1.username, t2.* 
      FROM $tableUsers AS t1 
      JOIN $tablePosts as t2 ON t1.id = t2.id_user 
      WHERE t2.status = 1 AND t2.id_topic = $category AND (t2.title LIKE '%$searchText%' OR t2.content LIKE '%$searchText%') LIMIT $limit OFFSET $offset"
    : "SELECT t1.username, t2.* 
      FROM $tableUsers AS t1 
      JOIN $tablePosts as t2 ON t1.id = t2.id_user 
      WHERE t2.status = 1  AND (t2.title LIKE '%$searchText%' OR t2.content LIKE '%$searchText%') LIMIT $limit OFFSET $offset";
  $query = $pdo->prepare($sql);
  $query->execute();

  dbCheckErr($query);
  return $query->fetchAll();
}

function countOfSearchPublPosts($table, $searchText, $category = null)
{
  global $pdo;
  $searchText = trim(strip_tags(stripslashes(htmlspecialchars($searchText))));
  $sql = $category != null
    ? "SELECT COUNT(*) FROM $table WHERE id_topic = $category AND status = 1 AND (title LIKE '%$searchText%' OR content LIKE '%$searchText%')"
    : "SELECT COUNT(*) FROM $table WHERE status = 1 AND (title LIKE '%$searchText%' OR content LIKE '%$searchText%')";
  $query = $pdo->prepare($sql);
  $query->execute();
  $col = $query->fetchColumn();

  dbCheckErr($query);
  return $col;
}