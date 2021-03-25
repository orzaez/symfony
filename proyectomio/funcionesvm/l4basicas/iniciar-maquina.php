<?php
$resultado= shell_exec('VBoxManage controlvm '.$_POST['valor'].' resume');
echo '<pre style="font-size: 16px">'.$resultado.'<pre>';
?>