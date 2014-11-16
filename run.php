<?php

$dir = opendir('.');

$dimensions = array(
    array(280, 150),
    array(210, 210),
    array(200, 150),
    array(150, 150)
);
$benchmark = array();

while ($file = readdir($dir)) {
    if (is_dir($file) && $file[0]!='.') {
        if (file_exists($file.'/plater.conf')) {
            echo "* Processing $file...\n";
            $benchmark[$file] = array();
            foreach ($dimensions as $dimension) {
                list($w, $h) = $dimension;
                $t = microtime(true);
                `rm $file/plate_*.stl 2> /dev/null`;
                `plater -t 4 -W $w -H $h -s 1.75 $file/plater.conf 2> /dev/null`;
                $plates = count(explode("\n",`ls $file/plate_*.stl 2> /dev/null`))-1;
                $e = round(microtime(true)-$t,2);
                $benchmark[$file][] = array(
                    'width' => $w,
                    'height' => $h,
                    'time' => $e,
                    'plates' => $plates
                );
                echo "~> Width: $w, Height: $h, Time: $e, Plates: $plates\n";
            }
        }
    }
}

fwrite(STDERR, var_export($benchmark, true));
