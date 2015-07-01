<?php
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=file.doc");

    echo "<html>";
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
    echo "<body>";
    echo "<b>My first document</b><br />";
    echo "This is test document and this is created by using by PHP headers (Sample data)";
    echo "</body>";
    echo "</html>";
?>