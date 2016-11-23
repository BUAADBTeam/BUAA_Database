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
    if(($type & 2) && is_numeric($val)) {
      return true;
    }
    if(($type & 4) && is_string($val)) {
      return true;
    }
    return false;
  }

  function userHasRole($role) {
    isset($_SESSION) or session_start();
  	if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === TRUE) {
      $user = $_SESSION['user'];

  	   
        $this->db->connect();
        $this->db->beginTransaction();
        try {
        $row = $this->db->select(array('COUNT(*)'), "users",
          "username = :user AND role = :role AND verified = 1", array(':user' => $user, ':role' => $role), "S")['row'];
        } catch(Exception $e) {
          $this->db->rollback();
          $this->db->close();
          return False;
        }
        $this->db->commit();
        $this->db->close();
    		if ($row[0] > 0) {
          $_SESSION['role'] = $role;
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
        // print_r($password);
        if ($this->databaseContainsUser($_POST['user'], $password)) {
          
          $this->db->connect();
          $this->db->beginTransaction();
          try{
          $row = $this->db->select(array('userid'), 'users', "username = :user", array(':user' => $_POST['user']), "S")['row'];
          } catch(Exception $e) {
            $this->db->rollback();
            $this->db->close();
            return False;
          }
          $this->db->commit();
          $userid = $row['userid'];

          isset($_SESSION) or session_start();

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
          unset($_SESSION['userid']);
          unset($_SESSION['role']);
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
        unset($_SESSION['userid']);
        unset($_SESSION['role']);
        return True;
        // header('Location: ' . base_url());
        // exit();
      }

      isset($_SESSION) or session_start();
      if (isset($_SESSION['loggedIn'])) {
        return $this->databaseContainsUser($_SESSION['user'], $_SESSION['pass']);
      }
      return FALSE;
  }

  function databaseContainsUser($user, $pass)
  {

      // $sql = "SELECT COUNT(*) FROM user
      //      WHERE user = :user AND password = :pass";
    
      $this->db->connect();
      $this->db->beginTransaction();
      try {
      $row = $this->db->select(array('COUNT(*)'), 'users', "username = :user AND password = :pass",array(':user' => $user, ':pass' => $pass), "S")['row'];
      // $row = $result->fetch();
      $this->db->commit();
      $this->db->close();
    } catch(Exception $e) {
      $this->db->rollback();
      $this->db->close();
      return False;
    }
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
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
      return FALSE;
    return TRUE;
  }

  function checkInfo(&$info = array(), $mode = '')
  {
      //判断信息是否未重复并且有效
      $this->db->connect();
      if($mode == 'user') {
        if(isset($info['username']) && $this->validName($info['username'])) {

          $this->db->beginTransaction();
          if($this->db->select(array('COUNT(*)'), 'users', "username = :username", array(':username' => $info['username']), "S")['row'][0] == 0) {
            $this->db->commit();
            $this->db->close();
            return TRUE;
          }
        }

        $this->db->close();
        return FALSE;
      }
      else if($mode == 'email') {
        if(isset($info['email']) && $this->validEmail($info['email'])) {
          $this->db->beginTransaction();
          if($this->db->select(array('COUNT(*)'), 'users', "email = :email", array(':email' => $info['email']), "S")['row'][0] == 0) {
            $this->db->commit();
            $this->db->close();
            return TRUE;
          }
        }
        $this->db->close();
        return FALSE; 
      }
      else {
        if(isset($info['email']) && $this->validEmail($info['email'])
        && 
        isset($info['username']) && $this->validName($info['username']) && 
        isset($info['password']) && $this->validType($info['password']) && 
        isset($info['role']) && is_numeric($info['role']) 
        && isset($info['phone']) && is_numeric($info['phone'])) {
          $this->db->beginTransaction();
        // print_r($info);
          if(($info['role'] + 0 <= 3 && $info['role'] + 0 >= 1) && $this->db->select(array('COUNT(*)'), 'users', "email = :email", array(':email' => $info['email']), "S")['row'][0] == 0 && $this->db->select(array('COUNT(*)'), 'users', "username = :username", array(':username' => $info['username']), "S")['row'][0] == 0) {
            // print_r($info);
            $this->db->commit();
            $this->db->close();
            unset($info['action']);
            return TRUE;
          }
        }
        $this->db->close();
        return FALSE;  
      }
  }

  function addUser($info, &$token)
  {
      try {
        if(!$this->checkInfo($info))   
          return FALSE;
        $neededInfo = array('username', 'password', 'email', 'role', 'phone', 'token');
        if($info['role'] != 3) {
          $neededInfo[] = 'address';
        }
        $this->db->connect();
        $this->db->beginTransaction();
        $token = md5($info['username'].rand(1,100).'buaaDb');
        $info['token'] = $token;
        $params = array();
        $columns = array();
        foreach ($info as $key => $value) {
          if(in_array($key, $neededInfo)) {
            $columns["$key"] = ":$key";
            $params[":$key"] = $value;
          }
        }
        // print_r($columns);
        // print_r($params);
        // $params[":password"] = md5($info['password']."buaadb");
        $columns['verified'] = 'FALSE';
        try {
          $id = $this->db->insert('users', $columns, $params);  
        } catch (Exception $e) {
          $this->db->rollback();
          $this->db->close();
          return FALSE;
        }
        
        $this->db->commit();
        $this->db->close();
        return TRUE;
      } catch(Exception $e) {
        $this->db->rollback();
        $this->db->close();
        return FALSE;
      }
  }


  function verify($username, $token)  
  {
      $this->db->connect();
      $this->db->beginTransaction();
      try {
        if(!is_string($username) || !is_string($token))
          return FALSE;
        $res = $this->db->select(array('COUNT(*)'), 'users', "username = :username AND token = :token", array(":username" => $username, ":token" => $token), "S")['row'][0];
        // $this->db->
        if(!($res == 1)) {
          $this->db->rollback();
          $this->db->close();
          return FALSE;
        }
        $this->db->update('users', array('verified' => True), "username = :username AND token = :token", array(":username" => $username, ":token" => $token));
        $this->db->commit();
        $this->db->close();
        return TRUE;
      } catch(Exception $e) {
        $this->db->rollback();
        $this->db->close();
        return FALSE;
      }
  }

  function insertPic($userid, $filename)
  {
      $this->db->connect();
      $this->db->beginTransaction();
      try { 
        $num = $this->db->update('users', array('photo' => ':photo'), "userid = :userid", array(':photo' => $filename, ':userid' => $userid));
        if($num != 1)
          return FALSE;
      } catch (Exception $e) {
        $this->db->rollback();
        $this->db->close();
        return False;
      }
      $this->db->commit();
      $this->db->close();
      return True;
  }

  function getPhoto($userid) 
  {
    $this->db->connect();
    $this->bd->beginTransaction();
    try {
        $res = $this->db->select(array('photo'), 'users', "userid = $userid", array());
        if(!empty($res['row']))
          $res = $res['row']['photo'];
    } catch (Exception $e) {
        $this->db->rollback();
        $this->db->close();
    }
    $this->db->commit();
    $this->db->close();
    return $res;
  }
}
