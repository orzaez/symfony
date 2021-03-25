<?php
$resultado= shell_exec('VBoxManage startvm "'.$_POST['valor'].'"');
echo '<pre style="font-size: 16px">'.$resultado.'<pre>';
?>
