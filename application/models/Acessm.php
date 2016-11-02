<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acessm extends Model 
{
  function __construct()
  {
    parent::__construct();
  }

  function userHasRole($role) {
    isset($_SESSION) or session_start();
  	if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === TRUE) {
      $user = $_SESSION['user'];

  	
      $this->db->connect();
      $row = $this->db->select(array('COUNT(*)'), "users",
        "username = :user AND role = :role", array(':user' => $user, ':role' => $role))['row'];
      $this->db->close();
  		if ($row[0] > 0) {
  			return True;
  		}
  		else {
  			$_GLOBALS['auth_error'] = "抱歉，您的权限不足";
  			return False;
  		}
  	}
  	else {
  		$_GLOBALS['auth_error'] = "请您先登录";
  		return False;
  	}
  }

  function userIsLoggedIn()
  {
      if (isset($_POST['action']) and $_POST['action'] == 'login') {
        if (!isset($_POST['user']) or $_POST['user'] == '' or
          !isset($_POST['pass']) or $_POST['pass'] == '') {
          $GLOBALS['loginError'] = 'Please fill in both fields';
          return False;
        }

        $password = md5($_POST['pass'] . 'buaadb');

        if ($this->databaseContainsUser($_POST['user'], $password)) {
          // $sql = "SELECT userid FROM users 
                  // WHERE user = :user;

          // $pdo = $this->db->connect();
          // $result = $pdo->prepare($sql);
          // $result->bindValue(':user', $_POST['user']);
          // $result->execute();
          $this->db->connect();
          $row = $this->db->select(array('userid'), 'users', "username = :user", array(':user' => $_POST['user']))['row'];
          // $row = $result->fetch($fetchstyle = PDO::FETCH_ASSOC);        
          $userid = $row['userid'];

          isset($_SESSION) or session_start();
          // session_register('loggedIn');
          // session_register('user');
          // session_register('pass');
          // session_register('userid');
          $_SESSION['loggedIn'] = True;
          $_SESSION['user'] = $_POST['user'];
          $_SESSION['pass'] = $password;
          $_SESSION['userid'] = $userid;
          $this->db->close();
          return True;
        }
        else {
          isset($_SESSION) or session_start();
          unset($_SESSION['loggedIn']);
          unset($_SESSION['user']);
          unset($_SESSION['pass']);
          $GLOBALS['loginError'] =
              'The specified email address or password was incorrect.';
          return False;
        }
      }

      if (isset($_POST['action']) and $_POST['action'] == 'logout') {
        isset($_SESSION) or session_start();
        unset($_SESSION['loggedIn']);
        unset($_SESSION['user']);
        unset($_SESSION['pass']);
        header('Location: ' . $_POST['goto']);
        exit();
      }

      isset($_SESSION) or session_start();
      if (isset($_SESSION['loggedIn'])) {
        return $this->databaseContainsUser($_SESSION['user'], $_SESSION['pass']);
      }
  }

  function databaseContainsUser($user, $pass)
  {

      // $sql = "SELECT COUNT(*) FROM user
      //      WHERE user = :user AND password = :pass";
      $this->db->connect();
      // $result = $pdo->prepare($sql);
      // $result->bindValue(':user', $user);
      // $result->bindValue(':pass', $pass);
      // $result->execute();
      $row = $this->db->select(array('COUNT(*)'), 'users', "username = :user AND password = :pass",array(':user' => $user, ':pass' => $pass))['row'];
      // $row = $result->fetch();
      $this->db->close();
      if ($row[0] == 1) {
        return TRUE;
      }
      else {
        return FALSE;
      }
  }
}
?>