<?php

/**
 * This dirty script allow to generate LaTeX tables from benchmarks
 * stderr outputs
 */

$sources = array(
    'plater' => 'Plater with all options (trying different orders), using center-of-mass heuristic',
    'no_gravity' => 'Plater with all options enabled, using center of parts instead of center of mass',
    'sort_surface_inc' => 'Using only surface increase order',
    'sort_surface_dec' => 'Using only surface decrease order',
    'sort_surface_random' => 'Using random order (some iterations)'
);

$dimensions = array(
    array(280, 150),
    array(210, 210),
    array(200, 150),
    array(150, 150)
);

function getResult($results, $width, $height) {
    foreach ($results as $result) {
        if ($result['width'] == $width && $result['height']) {
            return $result;
        }
    }
}

foreach ($sources as $source => $description) {
$time = 0;
$plates = 0;
?>
\begin{table}
\begin{tabular*}{\textwidth}{| @{\extracolsep{\fill}} l | l | l | l | l | l | l | l | l |}
\hline 
& \multicolumn{2}{c|}{\textbf{280x150}} & \multicolumn{2}{c|}{\textbf{210x210}} 
              & \multicolumn{2}{c|}{\textbf{200x150}} & \multicolumn{2}{c|}{\textbf{150x150}} \\
\hline
\textbf{Item} & 
\textbf{Time} & \textbf{Plates} & 
\textbf{Time} & \textbf{Plates} & 
\textbf{Time} & \textbf{Plates} & 
\textbf{Time} & \textbf{Plates} \\
\hline
<?php
    $filename = __DIR__.'/'.$source.'.txt';
    if (file_exists($filename)) {
        $data = eval('return '.file_get_contents($filename).';');
        ksort($data);
        foreach ($data as $name => $results) {
?>
\textbf{<?php echo str_replace('_', '\\_', $name); ?>} & 
<?php
            foreach ($dimensions as $k => $dimension) {
                $result = getResult($results, $dimension[0], $dimension[1]);
                echo round($result['time'], 1).' & ';
                echo $result['plates'];
                if ($k == (count($dimensions)-1)) echo ' \\\\'."\n\\hline\n";
                else echo ' & ';
                $time += $result['time'];
                $plates += $result['plates'];
            }
        }
    }
?>
\textbf{Total} &
\multicolumn{8}{c|}{
    \textbf{Computation time: <?php echo round($time, 1); ?> seconds, Generated plates: <?php echo $plates; ?>}
} \\
\hline
\end{tabular*}
\caption{<?php echo $description; ?>}
\end{table}

<?php
}
?>
