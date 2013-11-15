<?php

//error_reporting(0);
if (mysql_connect('localhost', 'admin', '111'))
{
    if (mysql_select_db('details_make'))
    {
        $query = "SELECT * FROM user ORDER BY id_user DESC";
        $res = mysql_query($query);
        if (!$res)
        {
            unset($query);
            header("location: ../error_data.html");
            exit;
        }
        echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
        echo '<link rel="stylesheet" type="text/css" href="../report2.css" >';
        echo '<div class="style">
                <div class="ribbon">
                  <div class="ribbon-front">
                    <div class="front-text">
                        Таблица пользователей:  
                    </div>
                  </div>
                
                <div class="ribbon-edge-topleft"></div>
                <div class="ribbon-edge-topright"></div>
                <div class="ribbon-edge-bottomleft"></div>
                <div class="ribbon-edge-bottomright"></div>
                <div class="ribbon-back-left"></div>
                <div class="ribbon-back-right"></div>';
        echo '<br>';
        echo '  <input type=button value=Назад onclick=location.href="../adminka.html" class=button1>    ';
        
        echo '  <input type=button value=Выход onclick=location.href="../PHP/exit.php" class=button1>    ';

        echo '<br><br><div class=center>';
        if (mysql_num_rows($res) > 0)
        {
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>#</th>';
            echo '<th class=large>Логин</th>';
            echo '<th class=large>Пароль</th>';
            echo '<th>Уровень доступа</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            echo '<tr>';
            echo '<form action="../PHP/admin.php" method="post" name="drop">';

       echo '<td>' .'<input type="submit" value="Ввод"  class="button1">' .'</td>';
            echo '<td>' . '<input type=text name="name" pattern="[a-z0-9]{1,10}" required>' . '</td>';
            echo '<td>' . '<input type=text name="passwd" pattern="[a-z0-9]{1,10}" required>' . '</td>';
            echo '<td>' . '<input type=text name="priority" pattern="[1-3]{1,1}" required>' . '</td>';
            echo '</form>';
            echo '<tr>';
            
            $j = mysql_num_rows($res);
            for ($i = 0; $i < $j; $i++)
            {
                $data = mysql_fetch_array($res);
                echo '<tr>';
                echo '<td>' . $data['id_user'] . '</td>';
                echo '<td>' . $data['name'] . '</td>';
                echo '<td>' . $data['passwd'] . '</td>';
                echo '<td>' . $data['priority'] . '</td>';
                echo '<tr>';
            }


            echo '</tbody>';
            echo '</table>';


            $n = $_POST['name'];
            $ps = $_POST['passwd'];
            $pr = $_POST['priority'];

            $est = mysql_num_rows(mysql_query("SELECT * FROM user WHERE name='$n' "));
 
            if (strlen($n) > 0 && $est == 0)
            {
                mysql_query("INSERT INTO `user`(`name`, `passwd`, `priority`) VALUES ('$n','$ps','$pr')");
//                unset($n);
//                unset($ps);
//                unset($pr);
            }
            else
            {
                unset($query);
                exit('<script>alert("Ошибка: '.mysql_error().'");</script>');
                //echo "FHISOEFH:KSDHF:USDBFUBSDFSJBFKJSBFKHSVDFHVSH<VFJHSD";
                exit();
            }
            unset($n);
            unset($ps);
            unset($pr);

        }
        else
        {
            unset($query);
            header("location: ../err/err_data.html");
            exit();
        }
        echo "</table>";
    }
    else
    {
        header("location: ../err/error_dbase.html");
        exit();
    }
}
else
{
    header("location: ../err/error_base.html");
    exit();
}
