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
  dbCheckErr($query);
}
// функция удаления данных из бд
function deleteRow(string $table, int $id): void
{
  global $pdo;
  $sql = "DELETE FROM $table WHERE id=$id";
  $pdo->query($sql);
}

// $data = selectAll('users');

// dump($data);

// Вытягиваем пользователя поста
function selectPostsOfUsers($tableUsers, $tablePosts)
{
  global $pdo;
  $sql = "SELECT t1.username, t2.* FROM $tableUsers AS t1 JOIN $tablePosts as t2 WHERE t1.id = t2.id_user";
  $query = $pdo->prepare($sql);
  $query->execute();

  dbCheckErr($query);

  return $query->fetchAll();
}

function selectPostsOfUser($tableUsers, $tablePosts, $postId)
{
  global $pdo;
  $sql = "SELECT t1.username, t2.* FROM $tableUsers AS t1 JOIN $tablePosts as t2 WHERE t1.id = t2.id_user AND t2.id = $postId";
  $query = $pdo->prepare($sql);
  $query->execute();

  dbCheckErr($query);

  return $query->fetch();
}