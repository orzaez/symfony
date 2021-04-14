<?php
shell_exec('docker run --name "'.$_POST['valor9'].'" -p "'.$_POST['puerto1'].'" -p "'.$_POST['puerto2'].'" "'.$_POST['valor10'].'"');
$resultado= shell_exec('docker ps -a');
echo '<pre style="font-size: 15px">'.$resultado.'<pre>';
?>
