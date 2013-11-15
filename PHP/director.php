<?php

error_reporting(0);
if (mysql_connect('localhost', $_COOKIE["log"], $_COOKIE["pas"]) && $_COOKIE["log"] == 'director')
{
    if (mysql_select_db('details_make'))
    {
echo '<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../report.css" />
        <link rel="stylesheet" type="text/css" href="../details.css" >
    </head>
    <body>
        <div class="style1">
            <div class="ribbon">
                <div class="ribbon-front">
                    <div class="front-text">
                        Выберите действие:  
                    </div>
                </div>

                <div class="ribbon-edge-topleft"></div>
                <div class="ribbon-edge-topright"></div>
                <div class="ribbon-edge-bottomleft"></div>
                <div class="ribbon-edge-bottomright"></div>
                <div class="ribbon-back-left"></div>
                <div class="ribbon-back-right"></div>
                <div class="form-signin">
                    <p>Вывод последних отчетов: </p>

                    <form action="../PHP/report1.php" method="post" name="drop_down" class="in">
                        <input type=text maxlength="4" placeholder="Количество" 
                                 name="numb" pattern="[0-9]{1,5}" required>
                        <input type="submit" name="submit2" value="Ввод" class="button">
                    </form>
                    <br>
                     <p>Вывод отчетов по фабрике: </p>
                    <form action="../PHP/report4.php" method="post" name="drop_down" class="in">';

                    $query = "SELECT name FROM manufactory "
                            . "ORDER BY id_manufac";
                    $res = mysql_query($query);
                    if (mysql_num_rows($res) > 0)
                    {
                        echo '<select name="menu" required>';
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
                    
                    echo     '         
                    <input type="submit" name="submit2" value="Ввод" class="button">
                    </form>
                    <br>
                    <p>Вывод отчета по месяцу:</p>
                    <p><form action="../PHP/report2.php" method="post" name="drop_down_box1" class="in">
                        <select name="menu1" size="1" required class="select_large">
                            <option disabled selected="selected">Месяц</option>
                            <option value="january">Январь</option>
                            <option value="february">Февраль</option>
                            <option value="march">Март</option>
                            <option value="april">Апрель</option>
                            <option value="may">Май</option>
                            <option value="june">Июнь</option>
                            <option value="july">Июль</option>
                            <option value="august">Август</option>
                            <option value="september">Сентябрь</option>
                            <option value="october">Октябрь</option>
                            <option value="november">Ноябрь</option>
                            <option value="december">Декабрь</option>  
                        </select>';

                    $query = "SELECT name FROM manufactory "
                            . "ORDER BY id_manufac";
                    $res = mysql_query($query);   
                    if (mysql_num_rows($res) > 0)
                    {       
                        echo '<select name="menu2" required>';
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
                    
                    echo   '
                        
                        <input type=text placeholder="Год"
                           name="year" pattern="[0-9]{4,4}" required>
                        <input type="submit" name="submit3" value="Ввод" class="button">
                    </form>
                    <br>
                    
                    <p>Вывод отчета в периоде:</p>
                    <form action="../PHP/report3.php" method="post" name="drop_down_box2" class="in">
                        <select name="menu3" required>
                            <option disabled selected="selected">Начиная с</option>
                            <option value="january">Январь</option>
                            <option value="february">Февраль</option>
                            <option value="march">Март</option>
                            <option value="april">Апрель</option>
                            <option value="may">Май</option>
                            <option value="june">Июнь</option>
                            <option value="july">Июль</option>
                            <option value="august">Август</option>
                            <option value="september">Сентябрь</option>
                            <option value="october">Октябрь</option>
                            <option value="november">Ноябрь</option>
                            <option value="december">Декабрь</option>  
                        </select>
                        <select name="menu4" required>
                            <option disabled selected="selected">По</option>
                            <option value="january">Январь</option>
                            <option value="february">Февраль</option>
                            <option value="march">Март</option>
                            <option value="april">Апрель</option>
                            <option value="may">Май</option>
                            <option value="june">Июнь</option>
                            <option value="july">Июль</option>
                            <option value="august">Август</option>
                            <option value="september">Сентябрь</option>
                            <option value="october">Октябрь</option>
                            <option value="november">Ноябрь</option>
                            <option value="december">Декабрь</option>  
                        </select>';
                        
                    $query = "SELECT name FROM manufactory "
                            . "ORDER BY id_manufac";
                    $res = mysql_query($query);   
                    if (mysql_num_rows($res) > 0)
                    {       
                        echo '<select name="menu5" required>';
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
                    
                    echo'
                        
                        <input type=text maxlength="4" placeholder="Год"
                        name="year" pattern="[0-9]{4,4}" required>
                        <input type="submit" name="submit3" value="Ввод" class="button">
                    </form>

                     <br>
                     <form action="../PHP/exit.php" method="post" name="drop_down" class="in">
                     <p><input type="submit" name="submit50" value="Выход" class="button"></p>
                     </form> 
               </div>
            </div>
        </div>
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