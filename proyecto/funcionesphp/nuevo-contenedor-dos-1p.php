<?php
$resultado=shell_exec('docker run --name "'.$_POST['valor9'].'" -p "'.$_POST['puerto1'].'" "'.$_POST['valor10'].'" && docker ps -a');
echo '<pre style="font-size: 15px">'.$resultado.'<pre>';
?>
