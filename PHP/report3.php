<?php

if (mysql_connect('localhost', $_COOKIE['log'], $_COOKIE['pas']) && $_COOKIE["log"]=='director')
{

    if (mysql_select_db('details_make'))
    {
        $monthStart = $_POST['menu3'];
        $monthEnd = $_POST['menu4'];
        $year = $_POST['year'];
        $fabric = $_POST['menu5'];
        $yearToday = date('Y');

        if ($year < 1990 || $year > $yearToday)
        {
            unset($year);
            unset($monthStart);
            unset($monthEnd);
            unset($fabric);
            header("location: ../err/error_data.html");
        }
        
        $query = "SELECT id_rep FROM report, manufactory "
                . "WHERE m_id_manuf=id_manufac AND month= '$monthStart' "
                . "AND year='$year' AND name='$fabric' ";
        $res = mysql_query($query);
        if (mysql_num_rows($res) > 0)
        {
            $data = mysql_fetch_array($res);
            $start = $data['id_rep'];
        }
        else
        {
            header("location: ../err/error_data.html");
            exit;
        }
        $query = "SELECT id_rep FROM report, manufactory "
                . "WHERE m_id_manuf=id_manufac AND month= '$monthEnd' "
                . "AND year='$year' AND name='$fabric' ";
        $res = mysql_query($query);
        if (mysql_num_rows($res) > 0)
        {
            $data = mysql_fetch_array($res);
            $end = $data['id_rep'];
        }
        else
        {
            $query = "SELECT id_rep FROM report, manufactory "
                . "WHERE m_id_manuf = id_manufac "
                . "AND year = '$year' AND name = '$fabric' "
                . "ORDER BY id_rep DESC";
            $res = mysql_query($query);
            $data = mysql_fetch_array($res);
            $end = $data['id_rep'];
        }
        $query = "SELECT * FROM report, manufactory "
                . "WHERE m_id_manuf=id_manufac "
                . "AND id_rep >= '$start' AND id_rep <= '$end' "
                . "AND year='$year' AND name='$fabric' ";
        $res = mysql_query($query);
        if (($tmp = mysql_num_rows($res)) > 0 && $end - $start >= 0)
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
            for ($i = 0; $i < $tmp ; $i++)
            {
                $data = mysql_fetch_array($res);
                echo '<tr>';
                echo '<td>' . $data['year'] . '</td>';
                echo '<td>' . $data['month'] . '</td>';
                echo '<td>' . $data['number'] . '</td>';
                echo '<td>' . $data['name'] . '</td>';
                echo '<tr>';
            }
        }
        else
        {
            unset($year);
            unset($monthStart);
            unset($monthEnd);
            unset($fabric);
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
