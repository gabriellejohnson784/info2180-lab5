<?php

$host = 'localhost';
$port = '3307';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);

$searchedCountry = isset($_GET['country']) ? $_GET['country'] : '';
$lookupType = isset($_GET['lookup']) ? $_GET['lookup'] : '';

if ($lookupType === "cities") {
    $cityStmt = $conn->query("SELECT cities.name AS city_name, cities.district, cities.population
                             FROM countries
                             JOIN cities ON countries.code = cities.country_code
                             WHERE countries.name LIKE '%$searchedCountry%'");
    $cityResults = $cityStmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>District</th>
                <th>Population</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cityResults as $cityRow): ?>
                <tr>
                    <td><?= $cityRow['city_name'] ?></td>
                    <td><?= $cityRow['district'] ?></td>
                    <td><?= $cityRow['population'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php } else {
    $countryStmt = $conn->query("SELECT name, continent, independence_year, head_of_state
                               FROM countries
                               WHERE name LIKE '%$searchedCountry%'");

    $countryResults = $countryStmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table>
        <thead>
            <tr>
                <th>Country Name</th>
                <th>Continent</th>
                <th>Independence Year</th>
                <th>Head of State</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($countryResults as $countryRow): ?>
                <tr>
                    <td><?= $countryRow['name'] ?></td>
                    <td><?= $countryRow['continent'] ?></td>
                    <td><?= $countryRow['independence_year'] ?></td>
                    <td><?= $countryRow['head_of_state'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php }

?>
