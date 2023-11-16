<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Check if the 'country' parameter is set
if (isset($_GET['country'])) {
    $country = $_GET['country'];

    //Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    //var_dump($stmt);
    $stmt->bindValue(':country', '%' . $country . '%', PDO::PARAM_STR);

    // Output the SQL query for debugging
     //var_dump($stmt->queryString);

    $stmt->execute();
} else {
    // If no country parameter is set, fetch all countries
    $stmt = $conn->query("SELECT * FROM countries");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output the received GET parameters and results for debugging
// var_dump($_GET);
 //var_dump($results);

// Output the HTML list
?>
<ul>
    <?php foreach ($results as $row): ?>
        <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
    <?php endforeach; ?>
</ul>
<!-- working up to Question 4 -->

<table border="1">
        <tr>
            <th>Country Name</th>
            <th>Continent</th>
            <th>Independence Year</th>
            <th>Head of State</th>
        </tr>
          
        <?php foreach ($results as $row): ?>
          <tr>
           <td> <?= $row['name']?></td>
           <td> <?= $row['continent']?></td>
           <td> <?= $row['independence_year']?></td>
           <td> <?= $row['head_of_state']?></td>
           
           <!-- '<td>' . $row['continent'] . '</td>';
           '<td>' . $row['independence_year'] . '</td>';
           '<td>' . $row['head_of_state'] . '</td>'; -->
           </tr>
        <?php endforeach; ?>
        
</table>