<?php 

error_reporting(0);
if (mysql_connect('localhost', $_COOKIE["log"], $_COOKIE["pas"]) && $_COOKIE["log"] == 'manager')
{
    if (mysql_select_db('details_make'))
    {
        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <title></title>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link rel="stylesheet" type="text/css" href="../details.css" >
            <link rel="stylesheet" type="text/css" href="../manager.css" >
        </head>
        <body>
            <div class="style1">
                <div class="ribbon">
                    <div class="ribbon-front">
                        <div class="front-text">
                            Ввод:  
                        </div>
                    </div>

                    <div class="ribbon-edge-topleft"></div>
                    <div class="ribbon-edge-topright"></div>
                    <div class="ribbon-edge-bottomleft"></div>
                    <div class="ribbon-edge-bottomright"></div>
                    <div class="ribbon-back-left"></div>
                    <div class="ribbon-back-right"></div>
                    <div class="form-signin">';
                    
                    echo 'Количество деталей: <p class=small>'
                       . '<form action="../PHP/success_query.php" method="post" class=in>';
                    echo '<input type=text maxlength="10" placeholder="Количество"
                            name="part_number" pattern="[0-9]{0,10}" required><p class=small>';
                    echo 'Дата в формате ГГГГ-ММ-ДД:';
                    echo '<p class=small><input type=text maxlength="10" placeholder="Дата"
                            name="part_data" pattern="\d{4}-\d{2}-\d{2}" required><p class=small>';
                    echo 'Вид детали: <p class=small>';    
                        $query = "SELECT name FROM detail "
                                . "ORDER BY id_detail";
                        $res = mysql_query($query);   
                        if (mysql_num_rows($res) > 0)
                        {       
                            echo '<select name="menu_part1" required>';
                            echo '<option disabled selected="selected">Деталь</option>';
                            $tmp = mysql_num_rows($res);
                            for ( $i = 0; $i < $tmp; $i++ )
                            {   
                                $data = mysql_fetch_array($res);
                                echo '<option value="'. $data['name'] .' "> ';
                                echo $data['name'];
                                echo '</option>';
                            }
                            echo '</select><p class=small>';
                        }
                        unset($query);

                        echo 'Тип заготовки: <p class=small>';
                        $query = "SELECT material FROM billet "
                                . "ORDER BY id_billet";
                        $res = mysql_query($query);   
                        if (mysql_num_rows($res) > 0)
                        {       
                            echo '<select name="menu_part2" required>';
                            echo '<option disabled selected="selected">Заготовка</option>';
                            $tmp = mysql_num_rows($res);
                            for ( $i = 0; $i < $tmp; $i++ )
                            {   
                                $data = mysql_fetch_array($res);
                                echo '<option value="'. $data['material'] .' "> ';
                                echo $data['material'];
                                echo '</option>';
                            }
                            echo '</select><p class=small>';
                        }
                        unset($query);

                        echo 'Название фабрики: <p class=small>';
                        $query = "SELECT name FROM manufactory "
                                . "ORDER BY id_manufac";
                        $res = mysql_query($query);   
                        if (mysql_num_rows($res) > 0)
                        {       
                            echo '<select name="menu_part3" required>';
                            echo '<option disabled selected="selected">Фабрика</option>';
                            $tmp = mysql_num_rows($res);
                            for ( $i = 0; $i < $tmp; $i++ )
                            {   
                                $data = mysql_fetch_array($res);
                                echo '<option value="'. $data['name'] .' "> ';
                                echo $data['name'];
                                echo '</option>';
                            }
                            echo '</select>';
                        }
                        unset($query);
         echo '<p class=big><input name="new_part" type="submit" value="Ввод" class="button_small"></p>';
         echo '</form>';
         echo ' <form action="../PHP/manager.php" method="post"> 
                <input name="return" type="submit" value="Назад" class="button_small">
                </form>';
         echo ' <br><form action="../PHP/exit.php" method="post">
                <p class=small><input type="submit" value="Выход" class="button_small"></p>
                </form>
        </body>
        </html> ';
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