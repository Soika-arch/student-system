<?php

/**
 *
 */
class User {

  // Аутентифицирован ли объект с реальной записью в БД. False - не аутентифицирован.
  private $is;
  // Уровень доступа пользователя согласно константе UserStatus.
  private $status;

  /**
   * Инициализация текущего пользователя.
   */
  public function __construct () {
    if (isset($_SESSION["user"]["is"]) && $_SESSION["user"]["is"] === true) {
      $this->is = true;
      $this->status = $_SESSION["user"]["status"];
    }
    else {
      $_SESSION["user"]["is"] = $this->is = false;
    }
  }

  public function __get (string $name) {
    if (isset($this->$name)) {
      return $this->$name;
    }

    debug("Клас ". __CLASS__ ." не має поля {$name}", __FILE__, __LINE__, 1);
  }

  function login (string $login, string $password) {
    $res = $this->userVerify($login, $password);

    if (empty($res)) {
      return false;
    }
    
    $this->authorization($res);

    return true;
  }

  /**
   * Верификация пользователя.
   * @param string $password - пароль, введенный пользователем.
   * @param string $dbPassword - пароль, полученный из БД.
   */
  private function userVerify (string $login, string $password) {
    $res = db_query("select * from users where login = '{$login}'")[0];

    if (password_verify(trim($password), $res["password"])) {
      return $res;
    }

    return [];
  }

  /**
   * Авторизация пользователя (создание сессии).
   * @param array $userRecord - запись пользователя из БД.
   */
  public function authorization (array $userRecord) {
    $this->is = true;
    $this->status = $userRecord["status_lvl"];

    setcookie("u1", $userRecord["id"], time() + 3600, WWW);

    $_SESSION["user"]["is"] = true;
    $_SESSION["user"]["id"] = $userRecord["id"];
    $_SESSION["user"]["login"] = $userRecord["login"];
    $_SESSION["user"]["status"] = $userRecord["status_lvl"];
    $_SESSION["user"]["statusAlias"] = array_search($userRecord["status_lvl"], UserStatus);
    $_SESSION["user"]["PHPSESSID"] = $_COOKIE["PHPSESSID"];
  }

  /**
   * Идентификация авторизованного пользвателя.
   */
  public function identification () {
    if (isset($_COOKIE["u1"]) && isset($_SESSION["user"]["PHPSESSID"])) {
      $flag = ($_COOKIE["u1"] == md5(AuthKey . $_SESSION["user"]["authPass"])) ? true : false;
      $flag = ($_SESSION["user"]["PHPSESSID"] == $_COOKIE["PHPSESSID"]) ? true : false;
    }
    else {
      $flag = false;
    }

    if ($flag) {
      setcookie("u1", $_SESSION["user"]["authHash"], time() + 3600, "/", Host);
    }

    return $flag;
  }

  /**
   * Проверка уровня доступа пользователя к текущему контроллеру.
   * @param int $lvlAccess - уровень доступа к контроллеру согласно константе UserStatus.
   */
  public function checkUserAccess (int $lvlAccess) {
    if ($this->status >= $lvlAccess) {
      return true;
    }
    else {
      header("Location: ". WWW ."/not-found");
    }
  }

  /**
   * Разлогин пользователя.
   */
  public function logout () {
    $this->is = false;
    $_SESSION["user"] = [];

    setcookie("u1", "", time() - 3600, "/", WWW);
    $_SESSION["user"]["is"] = $this->is;
  }
}