<?php

 setcookie("log"," ", time()-3600*3);
 setcookie("pas", " ", time()-3600*3);

header("location: http://test1.ru/index.html");
exit();
?>
