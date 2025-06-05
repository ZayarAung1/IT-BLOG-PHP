<?php 
include('../dbconnet.php');

define('BASE_URL', '/IT_BLOG/backend/');

//Path Routes
function route($file) {
    return BASE_URL . '/'. $file;
}


?>