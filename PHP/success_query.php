<?php
error_reporting(0);
if (mysql_connect('localhost', $_COOKIE["log"], $_COOKIE["pas"]) && $_COOKIE["log"] == 'manager' )
{
    if (mysql_select_db('details_make'))
    {
        echo '
        <html>
            <head>
                <title>TODO supply a title</title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <link rel="stylesheet" type="text/css" href="../details.css" />
            </head>
            <body>
                <div class="style">
                    <div class="ribbon">
                        <div class="ribbon-front">
                            <div class="front-text">
                                Выполнение запроса!  
                            </div>
                        </div>';
                        echo '<form action="PHP/index.php" method="post" class="form-signin">
                         <br>';
                        if (isset($_POST['part_number']))
                {
                            $part_number = $_POST['part_number'];
                            $part_data = $_POST['part_data'];
                            $part_detail = $_POST['menu_part1'];
                            $part_billet = $_POST['menu_part2'];
                            $part_manufactory = $_POST['menu_part3'];
                            
                            $query = "SELECT id_billet FROM billet "
                                . "WHERE material = '$part_billet' ";
                            $res = mysql_query($query);
                            $data = mysql_fetch_array($res);
                            $part_billet = $data['id_billet'];
                            
                            $query = "SELECT id_detail FROM detail "
                                . "WHERE name = '$part_detail' ";
                            $res = mysql_query($query);
                            $data = mysql_fetch_array($res);
                            $part_detail = $data['id_detail'];
                            
                            $query = "SELECT id_manufac FROM manufactory "
                                . "WHERE name = '$part_manufactory' ";
                            $res = mysql_query($query);
                            $data = mysql_fetch_array($res);
                            $part_manufactory = $data['id_manufac'];
                            
                            $query = "INSERT INTO  `details_make`.`part` (
                                        `id_part` ,
                                        `data` ,
                                        `number` ,
                                        `billet_code` ,
                                        `det_code` ,
                                        `m_id_nanuf`
                                        )
                                        VALUES (
                                        NULL , '$part_data', '$part_number', '$part_billet',
                                        '$part_detail', '$part_manufactory'
                                        )";                            
                            $res = mysql_query($query);
                            if ($res)
                            {    
                                 echo '<p>Запрос выполнен успешно!';
                            }
                            else
                            {    
                                 echo '<p>Запрос остался невыполненным!';
                            }    
                
                
                 unset ($_POST['part_number']);
                 unset ($_POST['part_data']);
                 unset ($_POST['menu_part1']);
                 unset ($_POST['menu_part2']);
                 unset ($_POST['menu_part3']);
                 }
                 if (isset($_POST['manufactory_name']))
                 {
                     $manufactory_name = $_POST['manufactory_name'];
                     $manufactory_address = $_POST['manufactory_address'];
                     $manufactory_data = $_POST['manufactory_data'];
                     $query = "INSERT INTO `manufactory`(`id_manufac`, `address`, "
                             . "`foundation`, `name`) "
                             . "VALUES (NULL,'$manufactory_address',"
                             . "'$manufactory_data','$manufactory_name')";                            
                        $res = mysql_query($query);
                        if ($res)
                        {    
                             echo '<p>Запрос выполнен успешно!';
                        }
                        else
                        {    
                             echo '<p>Запрос остался невыполненным!';
                        }
                     
                     unset ($_POST['manufactory_name']);
                     unset ($_POST['manufactory_address']);
                     unset ($_POST['manufactory_data']);
                 }
                 if (isset($_POST['billet_name']))
                 {
                     $billet_name = $_POST['billet_name'];
                     $billet_weight = $_POST['billet_weight'];
                     
                     $query = "INSERT INTO `billet`(`id_billet`, `weight`, `material`)"
                             . "VALUES (NULL,'$billet_weight','$billet_name')";                            
                        $res = mysql_query($query);
                        if ($res)
                        {    
                             echo '<p>Запрос выполнен успешно!';
                        }
                        else
                        {    
                             echo '<p>Запрос остался невыполненным!';
                        }
                     
                     unset ($_POST['billet_name']);
                     unset ($_POST['billet_weight']);
                 }
                 if (isset($_POST['details_name']))
                 {
                     $details_name = $_POST['details_name'];
                     $details_material = $_POST['details_material'];
                     $details_weight = $_POST['details_weight'];
                     $details_cost = $_POST['details_cost'];
                     $details_number = $_POST['details_number'];
                     $details_data = $_POST['details_data'];
                     
                     $query = "INSERT INTO `detail`(`id_detail`, `data`, "
                             . "`namber`, `weight`, `cost`, `material`, `name`) "
                             . "VALUES (NULL,'$details_data','$details_number',"
                             . "'$details_weight','$details_cost',"
                             . "'$details_material',$details_data)";                            
                        $res = mysql_query($query);
                        if ($res)
                        {    
                             echo '<p>Запрос выполнен успешно!';
                        }
                        else
                        {    
                             echo '<p>Запрос остался невыполненным!';
                        }
                     
                     unset ($_POST['details_name']);
                     unset ($_POST['details_material']);
                     unset ($_POST['details_weight']);
                     unset ($_POST['details_cost']);
                     unset ($_POST['details_number']);
                     unset ($_POST['details_data']);
                 }
                             echo '
                                <p>
                                <br>
                                <input name="return" type="button" value="Возврат" 
                                       onclick="history.back()" class="button">
                                
                                <input name="exit" type="button" value="Выход" 
                                       onclick="../PHP/exit.php" class="button">
                                <p>
                            </form>';
                
                 echo  '<div class="ribbon-edge-topleft"></div>
                        <div class="ribbon-edge-topright"></div>
                        <div class="ribbon-edge-bottomleft"></div>
                        <div class="ribbon-edge-bottomright"></div>
                        <div class="ribbon-back-left"></div>
                        <div class="ribbon-back-right"></div>
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