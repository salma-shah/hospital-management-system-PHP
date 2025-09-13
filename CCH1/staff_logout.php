<?php
include 'page_header.php';
session_start();
session_destroy();  // destroy the session for security purpose

    echo "<script>
    alert('You have successfully logged out!');
    window.location.href = 'staff_login.php';
</script>";

?>