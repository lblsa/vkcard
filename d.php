<?php 
echo '<pre>';
if ($handle = opendir('files/medium')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            echo "$entry\r\n";
        }
    }
    closedir($handle);
}
?>