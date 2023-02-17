<?php
require __DIR__ . '/connect.php';

function dump($val)
{
  echo '<pre>';
  print_r($val);
  echo '</pre>';
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
  // echo $sql;
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
}
// функция добавления данных в бд
function update($table, $id, $params)
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
}
// функция удаления данных из бд
function delete(string $table, int $id): void
{
  global $pdo;
  $sql = "DELETE FROM $table WHERE id=$id";
  $pdo->query($sql);
}

$arrData = [
  'admin' => 1,
  'username' => 'Eugen',
  'email' => 'eugen@afdsf.2sd',
  'password' => 'Eugen'
];

$params = [
  'admin' => 0,
  'username' => 'Andrei'
];

// update('users', 1, $arrData);
delete('users', 5);
$data = selectAll('users');

dump($data);