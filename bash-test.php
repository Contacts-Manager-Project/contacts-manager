<?php

$old_path = getcwd();
chdir('../');
$i = 0;
do {
$output = shell_exec("./bash-test.sh");

echo $output;
$i += 1;
} while ($i < 50000000);

chdir($old_path);