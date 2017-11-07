<?php
require '../class/access.php';

extract($_POST);

$oficialVersion = new Access_setups();


echo $oficialVersion->VerifyOficialVersions($machine, $drawing_no);

?>