<?php
function GoBackButton() {
   
    if(isset($_SERVER['HTTP_REFERER'])){
        $previousPage = $_SERVER['HTTP_REFERER'];
    } else {
        
        $previousPage = 'index.php'; 
    }
    
    echo '<form action="' . htmlspecialchars($previousPage) . '" method="get">';
    echo '<button type="submit">Go Back</button>';
    echo '</form>';
}