<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Check if the 'country' parameter is set
if (isset($_GET['country'])) {
    $country = $_GET['country'];

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->bindValue(':country', '%' . $country . '%', PDO::PARAM_STR);

    // Output the SQL query for debugging
    // var_dump($stmt->queryString);

    $stmt->execute();
} else {
    // If no country parameter is set, fetch all countries
    $stmt = $conn->query("SELECT * FROM countries");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output the received GET parameters and results for debugging
// var_dump($_GET);
// var_dump($results);

// Output the HTML list
?>
<ul>
    <?php foreach ($results as $row): ?>
        <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
    <?php endforeach; ?>
</ul>
