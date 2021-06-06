<?php

// Функции работы с БД.
//
// Все функции данного типа имеют префикс "db_".

require_once(ClassDir ."/exc/ExcDb.php");

/**
 * Возвращает подключение к БД.
 */
function db_connect () {
  $dsn = "mysql:host=" . DbHost . ";dbname=" . DbName . ";sharset=utf8";

  $options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
  ];

  // if (PDOException) $options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

  return new PDO($dsn, DbUser, DbPass, $options);
}

/**
 *
 */
function db_prepare (string $sql) {
  $dbh = db_connect();
  $sth = $dbh->prepare($sql);

  if (!$sth) {
    throw new ExcDb(1001, ["sql" => $sql]);
  }

  return $sth;
}

/**
 *
 */
function db_fetch (PDOStatement $sth) {
  debug($sth, __FILE__, __LINE__, 1);
  $sth->execute();
  $res = $sth->fetch();
  $_REQUEST["db"]["countQueries"]++;

  return $res;
}

/**
 *
 */
function db_fetchAll (PDOStatement $sth) {
  debug($sth, __FILE__, __LINE__, 1);
  $sth->execute();
  $res = $sth->fetchAll();
  $_REQUEST["db"]["countQueries"]++;

  return $res;
}

/**
 * Делает $sql запрос к БД и возвращает результат.
 * Следует использовать в тех случаях, когда в sql-запросе не используются данные от пользователя.
 */
function db_query (string $sql) {
  $_REQUEST["db"]["queries"][] = $sql;

  if ($_REQUEST["db"]["debug"]) {
    throw new ExcDb(1001, ["sql" => $sql]);
  }

  $mysqli = db_connect();
  $sth = $mysqli->prepare($sql);
  $result = $mysqli->query($sql);

  // # Запрос успешен. Подготовка строк запроса.

  if ($mysqli->affected_rows > 0) {
    $records = $result->fetch_all(MYSQLI_ASSOC);

    return $records;
  }

  return [];
}