<?php

if(isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    echo "<div style='background-color: #76ff03; color: #000000	; border: 1px solid #f5c6cb; padding: 10px; margin: 10px 0; border-radius: 5px;'>$success</div>";
    unset($_SESSION['success']);

} 
