<?php

function makeGood($param)
{
    $param = trim($param);
    $param = htmlspecialchars($param);
    $param = mysql_escape_string($param);
}

$login = $_POST['login'];
$password = $_POST['password'];

if (isset($_POST['submit']))
{
    makeGood($login);
    makeGood($password);
}

if (mysql_connect('localhost', 'watcher', 'watcher'))
{
    if (mysql_select_db('details_make'))
    {
        $query = "SELECT priority FROM `user` WHERE name='$login' AND passwd='$password' ";
        if ($priority = mysql_fetch_array(mysql_query($query)))
        {
            if ($priority[priority] == 1)
            {
                setcookie("log", "admin", time()+3600*3);
                setcookie("pas", "111", time()+3600*3);  
                header("location:../adminka.html");
                exit();
            }

            if ($priority[priority] == 2)
            {
                setcookie("log", "manager", time()+3600*3);
                setcookie("pas", "222", time()+3600*3);
                header("location:../PHP/manager.php");
                exit();
            }

            if ($priority[priority] == 3)
            {
                setcookie("log", "director", time()+3600*3);
                setcookie("pas", "111", time()+3600*3);
                header("location:../PHP/director.php");
                exit();
            }
        }
        else
        {
            header("location:../err/error_login.html");
            exit();
        }

        mysql_close();
    }
    else
    {
        header("location:../err/error_dbase.html");
        exit();
    }
}
else
{
    header("location:../err/error_base.html");
    exit();
}
?>


