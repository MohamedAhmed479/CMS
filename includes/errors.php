<?php

if(isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) {
        echo "<div style='background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; margin: 10px 0; border-radius: 5px;'>$error</div>";

    }
    unset($_SESSION['errors']);
} 


