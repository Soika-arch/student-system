<?php

/**
 * Дебаг функция
 */
function debug ($var, $file=__FILE__, $line=__LINE__, $ex=false) {
  echo "<div><i>file: {$file}, line: {$line}</i><br>\n";

  if (is_string($var)) {
    echo "<pre>string(". strlen($var) .")</pre><pre style='white-space:break-spaces'>". $var ."\n";
  }
  else {
    echo "<pre style='white-space:break-spaces'>\n";
    var_dump($var);
    echo "\n";
  }
  echo "</pre></div>\n";

  $ex ? exit() : ob_start();
}

// Повертає базове ім'я зазначеного шляху
define("Domein", basename(dirname(__FILE__)));

if (strpos($_SERVER["SERVER_NAME"], "beget.tech")) {
  // Константи підключення до БД
  define("DbHost", "localhost");
  define("DbName", "d66628w0_site");
  define("DbUser", "d66628w0_site");
  define("DbPass", "121010Secret");
  
  // Публічна папка сайту
  define("WWW", "http://". $_SERVER["SERVER_NAME"]);
}
else {
  // Константи підключення до БД
  define("DbHost", "localhost");
  define("DbName", "accounting_students");
  define("DbUser", "root");
  define("DbPass", "");

  // Публічна папка сайту
  define("WWW", "http://". Domein);
}

// Полный путь корня сайта.
define("Root", dirname(__FILE__));
define("Controller", Root ."/controllers");
define("Classes", Root ."/classes");
define("View", Root ."/views");
define("Func", Root ."/functions");

// Отримуємо url-запит і видаляємо слеши
$url = trim($_SERVER['REQUEST_URI'], "/");

// Отримуємо запит без GET-параметрів і зберігаємо у константу
define("StrQuery", explode("?", $url)[0]);

const UserStatus = [
  "locked" => 0,
  "user" => 1,
  "editor" => 2,
  "moderator" => 3,
  "administrator" => 4,
  "creator" => 5
];

require_once(Func ."/main.php");
require_once(Func ."/db.php");