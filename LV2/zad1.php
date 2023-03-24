<?php

$db_name='radovi';

$dir="backup/$db_name";
if(!is_dir($dir)){
    if(!@mkdir($dir)){
        die("<p>Ne možemo stvoriti direktorij $dir.</p></body></html>");
    }
}
$time = time();
$dbc = @mysqli_connect('localhost', 'root', '', $db_name) OR die("<p>Ne možemo se spojiti na bazu $db_name.</p></body></html>");
$r = mysqli_query($dbc, 'SHOW TABLES');
if (mysqli_num_rows($r) > 0) {
    echo "<p>Backup za bazu podataka '$db_name'.</p>";

    while (list($table) = mysqli_fetch_array($r, MYSQLI_NUM)) {
        $q = "SELECT * FROM $table";
        $r2 = mysqli_query($dbc, $q);

        if (mysqli_num_rows($r2) > 0) {

            if ($fp = gzopen ("$dir/{$table}_{$time}.txt.gz", 'w9')) {
            
                while ($row = mysqli_fetch_array($r2, MYSQLI_ASSOC)) {
                    foreach ($row as $value) {
                        $values = array();
                        foreach ($row as $key => $value) {
                            $values[] = "'".mysqli_real_escape_string($dbc, $value)."'";
                        }
                        $sql = "INSERT INTO $table(".implode(", ", array_keys($row)).") VALUES(".implode(", ", $values).")";
                    }
                    gzwrite ($fp, "$sql;");
                    gzwrite ($fp, "\n"); 

                }
                gzclose ($fp); 
                echo "<p>Tablica '$table' je pohranjena.</p>";

            } else {
                echo "<p>Datoteka $dir/{$table}_{$time}.txt se ne može otvoriti.</p>";
                break;
            }
        }
    } 

} else {
    echo "<p>Baza $db_name ne sadrži tablice.</p>";
}
?>