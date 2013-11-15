<?php
error_reporting(0);
if (mysql_connect('localhost', $_COOKIE["log"], $_COOKIE["pas"]) && $_COOKIE["log"] == 'manager' )
{
    if (mysql_select_db('details_make'))
    {
        $query = "SELECT address, foundation, name
                  FROM manufactory
                  ORDER BY id_manufac";
        $res = mysql_query($query);
        if (mysql_num_rows($res) > 0)
        {
        
        echo ' <head>
               <title>Вход</title>
               <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
               </head>  ';
        echo '<link rel="stylesheet" type="text/css" href="../report2.css" >';
        echo '<link rel="stylesheet" type="text/css" href="../manager.css" >';
        echo '<div class="style">
                <div class="ribbon">
                  <div class="ribbon-front">
                    <div class="front-text">
                        Мастерские:  
                    </div>
                  </div>
                
                <div class="ribbon-edge-topleft"></div>
                <div class="ribbon-edge-topright"></div>
                <div class="ribbon-edge-bottomleft"></div>
                <div class="ribbon-edge-bottomright"></div>
                <div class="ribbon-back-left"></div>
                <div class="ribbon-back-right"></div>';
        echo '<br>';
        echo '  <input type=button value=Назад onclick=location.href="../PHP/manager.php" class=button_small>    ';
        echo '  <input type=button value="Добавить новую" '
        . 'onclick=location.href="../PHP/new_manufactory.php" class=button_small>    ';
        echo '  <input type=button value=Выход onclick=location.href="../PHP/exit.php" class=button_small>    ';

        echo '<br><br><div class=center>';
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th class=super_big>Название</th>';
            echo '<th class=super_big>Адрес мануфактуры</th>';
            echo '<th class=super_big>Дата открытия</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            $tmp = mysql_num_rows($res);

            for ($i = 0; $i < $tmp; $i++)
            {
                $data = mysql_fetch_array($res);
                echo '<tr>';
                echo '<td>' . $data['name'] . '</td>';
                echo '<td>' . $data['address'] . '</td>';
                echo '<td>' . $data['foundation'] . '</td>';
                echo '<tr>';
            }
            echo '</tbody>';
            echo '</table>';
        }
        else
        {
            unset($query); 
            header("location: ../err/error_data.html");
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
?>
