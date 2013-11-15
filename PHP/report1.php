<?php

error_reporting(0);
if (mysql_connect('localhost', $_COOKIE["log"], $_COOKIE["pas"]) && $_COOKIE["log"]=='director')
{
    if (mysql_select_db('details_make'))
    {
        $query = "SELECT * FROM report, manufactory WHERE m_id_manuf=id_manufac GROUP BY id_rep ORDER BY id_rep DESC ";
        $res = mysql_query($query);
        if (!$res)
        {
            unset($query);
            header("location: ../error_data.html");
            exit;
        }
        echo ' <head>
               <title>Вход</title>
               <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
               </head>  ';
        echo '<link rel="stylesheet" type="text/css" href="../report2.css" >';
        echo '<div class="style">
                <div class="ribbon">
                  <div class="ribbon-front">
                    <div class="front-text">
                        Отчеты:  
                    </div>
                  </div>
                
                <div class="ribbon-edge-topleft"></div>
                <div class="ribbon-edge-topright"></div>
                <div class="ribbon-edge-bottomleft"></div>
                <div class="ribbon-edge-bottomright"></div>
                <div class="ribbon-back-left"></div>
                <div class="ribbon-back-right"></div>';
        echo '<br>';
        echo '  <input type=button value=Назад onclick=location.href="../PHP/director.php" class=button>    ';
        echo '  <input type=button value=Выход onclick=location.href="../PHP/exit.php" class=button>    ';

        echo '<br><br><div class=center>';
        if (mysql_num_rows($res) > 0)
        {
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Год</th>';
            echo '<th class=large>Месяц</th>';
            echo '<th class=large>Количество деталей</th>';
            echo '<th class=large>Название фабрики</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            $tmp = mysql_num_rows($res);

            if ($tmp - $_POST['numb'] < 0)
            {
                $j = $tmp;
            }
            else
            {
                $j = $_POST['numb'];
            }

            for ($i = $j; $i > 0; $i--)
            {
                $data = mysql_fetch_array($res);
                echo '<tr>';
                echo '<td>' . $data['year'] . '</td>';
                echo '<td>' . $data['month'] . '</td>';
                echo '<td>' . $data['number'] . '</td>';
                echo '<td>' . $data['name'] . '</td>';
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
