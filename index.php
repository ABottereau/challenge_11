<?php
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);

$firstname = trim($_POST['firstname']); 
$lastname = trim($_POST['lastname']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && is_string($_POST['firstname']) && is_string($_POST['lastname']) && strlen($_POST['firstname']) <= 45 && strlen($_POST['lastname']) <= 45) {
        $query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
        $statement = $pdo->prepare($query);

        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

        $statement->execute();
        header('Location: index.php');
    }
}





echo "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
    <title></title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th scope=\"col\">Prénom</th>
                <th scope=\"col\">Nom</th>
            </tr>
        </thead>
        <tbody>";
            $query = "SELECT * FROM friend";
            $statement = $pdo->query($query);
            $friends = $statement->fetchAll();
            foreach ($friends as $friend) {
                echo "<tr>";
                echo "<td>" . $friend['firstname'] . "</td>";
                echo "<td>" . $friend['lastname'] . "</td>";
                echo "</tr>";
            }
        echo "</tbody>";
    echo "</table>
    <h3>Ajouter</h3>
    <form action=\"index.php\" method=\"post\">
        <label for =\"firstName\">Prénom</label>
        <input type=\"text\" id=\"firstname\" name=\"firstname\" placeholder=\"45 caractères max.\">
        <label for =\"lastName\">Nom</label>
        <input type=\"text\" id=\"lastname\" name=\"lastname\" placeholder=\"45 caractères max.\">
        <button type=\"submit\">Valider</button>
</body>
</html>";