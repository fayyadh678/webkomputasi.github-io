<?php
function bersihkan_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    
    return $data;
    
}
?>