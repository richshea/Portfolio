<?php

    $dbhandle = mysql_connect("localhost", "briarmoss", "fourastwojsonel");
    $ok = mysql_select_db("portfolio");

    $date_array = explode (",", $_POST["date_array"]);

    $query = "delete from blog where date = \"$date_array[0]\" ";

    for ($i=1; $i < count($date_array); $i++) {
      $query .= "|| date=\"$date_array[$i]\" ";
    }
    $query .= ";";

    mysql_query($query);

    //return number of rows deleted
    echo mysql_affected_rows();

?>