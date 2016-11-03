<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acessm extends Model 
{
  function __construct()
  {
    parent::__construct();
  }

  private function validType($val, $type = 7)
  {
    if(($type & 1) && is_bool($val)) 
      return true;
    if(($type & 2) && is_numeric($val))
      return true;
    if(($type & 4) && is_string($val))
      return true;
    return false;
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
        header('Location: ' . base_url());
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

  private function validName($name)
  {
    if(!is_string($name))
      return FALSE;
    return TRUE;
  }

  private function validEmail($email)
  {
    if(!is_string($email))
      return FALSE;
    return TRUE
  }

  function checkInfo($info = array(), $mode = '')
  {
      //判断信息是否未重复并且有效
      $this->db->connect();
      if($mode == 'user') {
        if(isset($info['username']) && $this->validName($info['username'])) {
          if($this->db->select('COUNT(*)', 'users', "username = :username", array(':username' => $info['username']))['row'][0] == 0) {
            $this->db->close();
            return TRUE;
          }
        }
        $this->db->close();
        return FALSE;
      }
      if($mode == 'email') {
        if(isset($info['email']) && $this->validEmail($info['email'])) {
          if($this->db->select('COUNT(*)', 'users', "email = :email", array(':email' => $info['email']))['row'][0] == 0) {
            $this->db->close();
            return TRUE;
          }
        }
        $this->db->close();
        return FALSE; 
      }
      else {
        // if()
        if(isset($info['email']) && $this->validEmail($info['email'])
        && isset($info['username'] && $this->validName($info['username'])) && isset($info['password']) && $this->validType($info['password']) && isset($info['$type']) && is_numeric($info['type']) && count($info) == 4) {

          if(($info['type'] + 0 <= 3 && $info['type'] + 0 >= 1) && $this->db->select('COUNT(*)', 'users', "email = :email", array(':email' => $info['email']))['row'][0] == 0) {
            $this->db->close();
            return TRUE;
          }
        }
        $this->db->close();
        return FALSE;  
      }
  }

  function addUser($info, &$token)
  {
      if(!$this->checkInfo($info))   
        return FALSE;
      $this->db->connect();
      $token = md5($info['username'].rand(1,100).'buaaDb');
      $params = array();
      $columns = array();
      foreach ($info as $key => $value) {
        $columns["$key"] = ":$key";
        $params[":$key"] = $value;
      }
      $columns['verified'] = FALSE;
      $columns['token'] = $token;
      $id = $this->db->insert('users', $columns, $params);
      $this->db->close();
      return $id > 0 ? TRUE : FALSE;
  }


  function verify($username, $token)  
  {
      if(!is_string($username) || !is_string($token))
        return FALSE;
      $res = $this->db->select('COUNT(*)', 'users', "username = :username AND token = :token", array(":username" => $username, ":token" => $token))['num'][0];
      if(!($res == 1))
        return FALSE;
      $this->db->update('users', array('status' => True), "username = :username AND token = :token", array(":username" => $username, ":token" => $token));
      return TRUE;
  }

}
?>