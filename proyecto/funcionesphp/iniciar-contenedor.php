<?php
shell_exec('docker start "'.$_POST['valor3'].'"');
$resultado= shell_exec('docker ps -a');
echo '<pre style="font-size: 15px">'.$resultado.'<pre>';
?>

