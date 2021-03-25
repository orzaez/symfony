<?php
$resultado= shell_exec('VBoxManage controlvm '.$_POST['valor'].' reset');
echo '<pre style="font-size: 16px">'.$resultado.'<pre>';
?>