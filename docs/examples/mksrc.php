<?php
$location = './';
$d = dir($location);
while (false !== ($entry = $d->read())) {
    if ($entry == '.' || $entry == '..' || $entry == basename(__FILE__)) {
        continue;
    }
    $ext = explode('.', $entry);
    if (isset($ext[1]) && $ext[1] == 'php') {
        copy($location.$entry,$location.$entry.'s');
        echo 'Copying '.$entry.' to '.$entry."s\n";
    }
}
$d->close();
echo 'Mksrc complete';
?>