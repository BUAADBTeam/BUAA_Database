<?php
{
	if(isset($_SESSION['loggedin']) && $_SESSION['loggedIn'] === TRUE) {
		$user = $_SESSION['user'];

		$sql = "SELECT CONUT(*) FROM author 
			INNER JOIN authorrole ON author.id = authorid
			INNER JOIN role ON roleid = role.id
			WHERE user = $user AND role.id = $role";

		$result = $db->query($sql);
		$row = $result->fetch_row();

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
      if (!isset($_POST['user']) or $_POST['user'] == '' or
        !isset($_POST['pass']) or $_POST['pass'] == '')
      {
        $GLOBALS['loginError'] = 'Please fill in both fields';
        return FALSE;
      }

      $password = md5($_POST['pass'] . 'buaadb');

      if (databaseContainsAuthor($_POST['user'], $password))
      {
        session_start();
        $_SESSION['loggedIn'] = TRUE;
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['pass'] = $password;
        return TRUE;
      }
      else
      {
        session_start();
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
      session_start();
      unset($_SESSION['loggedIn']);
      unset($_SESSION['user']);
      unset($_SESSION['pass']);
      header('Location: ' . $_POST['goto']);
      exit();
    }

    session_start();
    if (isset($_SESSION['loggedIn']))
    {
      return databaseContainsAuthor($_SESSION['user'], $_SESSION['pass']);
    }
}

function databaseContainsAuthor($user, $pass, $db)
{

    $sql = "SELECT COUNT(*) FROM user
         WHERE user = $user AND password = $pass";

    $result = $db->query($sql);
    $row = $result->fetch_row();

    if ($row[0] > 0)
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
}
?>