<?php
// Set $title_page_name based on the actual name of the PHP file
$title_page_name = basename($_SERVER['SCRIPT_FILENAME'], '.php');
if($title_page_name != 'index') {
    $title_page_name = str_replace('-', ' ', $title_page_name);
    $title_page_name = ucwords($title_page_name);
} else {
    $title_page_name = null;
}
?>