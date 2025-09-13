

<?php
include ('connection.php');
if (isset($_GET['keyword'])){

    $searchQuery = trim($_GET['keyword']);

    // this is used to prevent SQL injections
    $stmt = $connection->prepare("SELECT page_url FROM services WHERE keywords LIKE ? OR service_name LIKE ? ORDER BY LENGTH(keywords) LIMIT 1"); 
    // check if keyword matches service name or any keywords
    // store in variable, even partial matches
    $likeQuery = "%$searchQuery%";
    $stmt->bind_param("ss", $likeQuery, $likeQuery);  // two string parameters
    $stmt->execute();  // execute it
    $stmt->bind_result($page_url);   // bind the result variable

    if ($stmt->fetch()) {
        header("Location: $page_url"); // Redirect to the closest matching page
        exit();
    } else {
        header("Location: no_results.php"); // Redirect to a "No Results Found" page
        exit();
    }
    
    $stmt->close();
}
    ?>
