<?php 

function clean_data($input) {
    $input = @strip_tags($input);
    $input = @stripslashes($input);
    return $input;
}

?>