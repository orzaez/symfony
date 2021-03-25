<?php
$resultado= shell_exec('VBoxManage extpack install');
echo '<pre style="font-size: 16px">'.$resultado.'<pre>';
?>
