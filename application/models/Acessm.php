<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acessm extends Model 
{
  function __construct()
  {
    parent::__construct();
  }

  function user_has_role($role) {
    isser($_SESSION) OR session_start();
  	if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === TRUE) {
  		$user = $_SESSION['user'];

  		// $sql = "SELECT CONUT(*) FROM users 
  			// INNER JOIN userrole ON user.id = userid
  			// INNER JOIN role ON roleid = role.id
  		// 	WHERE user = :user AND role.id = :role";


    //   $pdo = $this->db->connect();
  		// $result = $pdo->prepare($sql);
    //   $result->bindValue(':user', $user);
    //   $result->bindValue(':role', $role);
  		// $result->execute();
      $this->db->connect();
      $row = $this->db->select('COUNT(*)', "users 
        INNER JOIN userrole ON user.id = userid
        INNER JOIN role ON roleid = role.id",
        "user = :user AND role.id = :role", array(':user' => $user, ':role' => $role));
      $this->db->close();
  		if($row[0] > 0) {
  			return TRUE;
  		}
  		else {
  			$_GLOBALS['auth_error'] = "抱歉，您的权限不足";
  			return FALSE;
  		}
  	}
  	else {
  		$_GLOBALS['auth_error'] = "请您先登录";
  		return FALSE;
  	}
  }

  function userIsLoggedIn()
  {
      if (isset($_POST['action']) and $_POST['action'] == 'login')
      {
        if (!isset($_POST['username']) or $_POST['username'] == '' or
          !isset($_POST['password']) or $_POST['password'] == '')
        {
          $GLOBALS['loginError'] = 'Please fill in both fields';
          return FALSE;
        }

        $password = md5($_POST['password'] . 'buaadb');

        if (databaseContainsAuthor($_POST['username'], $password))
        {
          // $sql = "SELECT userid FROM users 
                  // WHERE user = :user;

          // $pdo = $this->db->connect();
          // $result = $pdo->prepare($sql);
          // $result->bindValue(':user', $_POST['user']);
          // $result->execute();
          $this->db->connect();
          $row = $this->db->select(array('userid'), 'user', "user = :user", array(':user' => $user))->row;
          // $row = $result->fetch($fetchstyle = PDO::FETCH_ASSOC);        
          $userid = $row['userid'];

          isser($_SESSION) OR session_start();
          session_register('loggedIn');
          session_register('user');
          session_register('pass');
          session_register('userid');
          $_SESSION['loggedIn'] = TRUE;
          $_SESSION['user'] = $_POST['user'];
          $_SESSION['pass'] = $password;
          $_SESSION['userid'] = $userid;
          $this->db->close();
          return TRUE;
        }
        else
        {
          isser($_SESSION) OR session_start();
          unset($_SESSION['loggedIn']);
          unset($_SESSION['user']);
          unset($_SESSION['pass']);
          $GLOBALS['loginError'] =
              'The specified email address or password was incorrect.';
          return FALSE;
        }
      }

      if (isset($_POST['action']) and $_POST['action'] == 'logout')
      {
        isser($_SESSION) OR session_start();
        unset($_SESSION['loggedIn']);
        unset($_SESSION['user']);
        unset($_SESSION['pass']);
        header('Location: ' . $_POST['goto']);
        exit();
      }

      isser($_SESSION) OR session_start();
      if (isset($_SESSION['loggedIn']))
      {
        return databaseContainsAuthor($_SESSION['user'], $_SESSION['pass']);
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
      $row = $this->db->select(array('COUNT(*)'), 'user', "user = :user AND password = :pass",array(':user' => $user, ':pass' => $pass))->row;
      // $row = $result->fetch();
      $this->db->close();
      if ($row[0] > 0)
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
  }
}
?>