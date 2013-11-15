<?php

if (mysql_connect('localhost', $_COOKIE['log'], $_COOKIE['pas']) && $_COOKIE["log"]=='director')
{

    if (mysql_select_db('details_make'))
    {
        $month = $_POST['menu1'];
        $year = $_POST['year'];
        $fabric = $_POST['menu2'];

        if ($year < 1990 || $year > 2014)
        {
            unset($year);
            unset($month);
            unset($fabric);
            header("location: ../err/error_data.html");
            exit;
        }
        $query = "SELECT * FROM report, manufactory "
                . "WHERE m_id_manuf=id_manufac AND month= LOWER('$month') "
                . "AND year='$year' AND name='$fabric' ";
        $res = mysql_query($query);
        if (mysql_num_rows($res) > 0)
        {
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
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<tr>';
            echo '<th>Год</th>';
            echo '<th class=large>Месяц</th>';
            echo '<th class=large>Количество деталей</th>';
            echo '<th class=large>Название фабрики</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            $data = mysql_fetch_array($res);
            echo '<tr>';
            echo '<td>' . $data['year'] . '</td>';
            echo '<td>' . $data['month'] . '</td>';
            echo '<td>' . $data['number'] . '</td>';
            echo '<td>' . $data['name'] . '</td>';
            echo '<tr>';
        }
        else
        {
            unset($year);
            unset($month);
            header("location: ../err/error_data.html");
            exit;
        }
        echo "</table>";
        echo '  </div>
              </div>';
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
