<?php
include "config/config.php";

$navTEMP = <<<EOT
<ul>
    <li><a href="foodmenumanagement/dishmanagement.php/view">Dish Management</a></li>
    <li><a href = "payment.php">Payment</a><li>
</ul>
EOT;

echo $navTEMP;