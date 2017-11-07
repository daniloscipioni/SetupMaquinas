<?php
require '../class/access.php';

$InsertData = new Access_setups();

$InsertData->InsertSetup($_POST);

?>