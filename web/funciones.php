<?php
require "../mysql/Query.php";

function getGacetas()
{
    $query = new Query();
    $rows = null;
    $sql = "SELECT * FROM `gacetas` WHERE `band` = 1;";
    $rows = $query->getAll($sql);
    return $rows;
}

$gacetas = getGacetas();

?>