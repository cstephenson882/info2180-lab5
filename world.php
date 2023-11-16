<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['country'])) {
    $country_input = $_GET['country'];
    //echo $country;

    // Check if the lookup parameter is set to cities
    if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
        // SQL query for cities lookup
        $stmt = $conn->prepare("SELECT cty.name, cty.district, cty.population 
                                FROM cities cty 
                                JOIN countries cs ON cty.country_code = cs.code 
                                WHERE cs.name LIKE :country");
    } else {
        // Default SQL query for country lookup
        $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    }

    $stmt->bindValue(':country', '%' . $country_input . '%', PDO::PARAM_STR);
    $stmt->execute();
} else {
    $stmt = $conn->query("SELECT * FROM countries");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output the HTML table for both country and cities lookup
echo '<table border="1">';
    if(isset($_GET['lookup']) && $_GET['lookup'] == 'cities') { // decides the table header
        
        echo ' <thead>
                    <tr>
                        <th>Name</th>
                        <th>District</th>
                        <th>Population</th>
                    </tr> 
                </thead>';
    }
    else {
        echo '  <thead>
                    <tr>
                        <th>Country Name</th>
                        <th>Continent</th>
                        <th>Independence Year</th>
                        <th>Head of State</th>
                    </tr>
                </thead>';
        }
        foreach ($results as $row) {
            echo '<tbody>'; 
                    echo '<tr>';
                        // echo '<td>' . $row['name'] . '</td>';
                        
                        // For cities lookup, display district and population
                        if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['district'] . '</td>';
                            echo '<td>' . $row['population'] . '</td>';
                        } else {
                            // For country lookup, display continent and head_of_state
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['continent'] . '</td>';
                            echo '<td>' . $row['independence_year'] . '</td>';
                            echo '<td>' . $row['head_of_state'] . '</td>';
                            
                        }

                    echo '</tr>';
                echo '<tbody> ';
        }
echo '</table>';

?>
