<?php

error_reporting(0);
if (mysql_connect('localhost', $_COOKIE["log"], $_COOKIE["pas"]) && $_COOKIE["log"] == 'manager' )
{
    if (mysql_select_db('details_make'))
    {
        $query = "SELECT `part`.`data`,`part`.`number`,`billet`.`material`,
            `manufactory`.`name`,`detail`.`name` 
            FROM part
            LEFT JOIN `details_make`.`billet` 
            ON `part`.`billet_code` = `billet`.`id_billet` 
            LEFT JOIN `details_make`.`detail` 
            ON `part`.`det_code` = `detail`.`id_detail` 
            LEFT JOIN `details_make`.`manufactory` 
            ON `part`.`m_id_nanuf` = `manufactory`.`id_manufac`
            ORDER BY `part`.`data` DESC";
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
                        Партии:  
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
        echo '  <input type=button value="Добавить новую" onclick=location.href="../PHP/new_part.php" class=button_small>    ';
        echo '  <input type=button value=Выход onclick=location.href="../PHP/exit.php" class=button_small>    ';

        echo '<br><br><div class=center>';

            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Количество деталей</th>';
            echo '<th class=large_mid>Дата</th>';
            echo '<th class=large>Вид детали</th>';
            echo '<th class=large>Вид заготовки</th>';
            echo '<th class=large>Фабрика</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            $tmp = mysql_num_rows($res);

            for ($i = 0; $i < $tmp; $i++)
            {
                $data = mysql_fetch_array($res);
                echo '<tr>';
                echo '<td>' . $data['number'] . '</td>';
                echo '<td>' . $data['data'] . '</td>';
                echo '<td>' . $data['name'] . '</td>';
                echo '<td>' . $data['material'] . '</td>';
                echo '<td>' . $data[3] . '</td>';
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

