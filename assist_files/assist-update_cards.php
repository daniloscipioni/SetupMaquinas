<?php
require '../class/access.php';

extract($_POST);

$updateSetup = new Access_setups();

$updateSetup->UpdateSetup($drawing_no, $machine, $id_setup, $produnits, $func);

?>