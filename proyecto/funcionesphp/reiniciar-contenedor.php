<?php
shell_exec('docker restart "'.$_POST['valor4'].'"');
$resultado= shell_exec('docker ps -a');
echo '<pre style="font-size: 15px">'.$resultado.'<pre>';
?>

