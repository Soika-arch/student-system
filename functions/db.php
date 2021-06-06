<?php 

// Функціі для роботи с БД

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
  $pdo = db_connect();
  $sth = $pdo->prepare($sql);

  if (!$sth) {
    exit("Помилка підключення до БД");
  }

  return $sth;
}

function db_query (string $sql) {
	$sth = db_prepare($sql);

  	if ($sth->execute()) {
  		return $sth->fetchAll();
  	}
  	else {
  		echo "<p>Помилка запросу до БД<br>SQl: <pre>". $sth->queryString;
  		var_dump($sth->errorInfo());
  		echo "</pre></p>";
  		exit();
  	}
}