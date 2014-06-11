<?php

$dir = opendir('.');

$dimensions = array(
    array(280, 150),
    array(210, 210),
    array(150, 150)
);

while ($file = readdir($dir)) {
    if (is_dir($file) && $file!='.' && $file!='..') {
        echo "* Processing $file...\n";
        foreach ($dimensions as $dimension) {
            list($w, $h) = $dimension;
            $t = microtime(true);
            `rm $file/plate_*.stl 2> /dev/null`;
            `plater -t 4 -W $w -H $h -s 2 $file/plater.conf 2> /dev/null`;
            $plates = count(explode("\n",`ls $file/plate_*.stl`))-1;
            $e = microtime(true)-$t;
            echo "~> Width: $w, Height: $h, Time: $e, Plates: $plates\n";
        }
    }
}
