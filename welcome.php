<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pekáreň</title>
    <style>
        body {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            margin: 0;
            flex-direction: row;
            background-color: #00224D;
            color: #A0153E;
        }

        img {
            height: 200px;
            aspect-ratio: 16/10;
        }

        .side-bar {
            display: flex;
            flex-direction: column;
            margin: 20px;
        }

        .sort-buttons, .filters, .stats {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .stats p, .sort-buttons button {
            margin: 10px 0;
        }

        .sort-buttons button {
            padding: 10px 20px;
            background-color: #FF204E;
            color: #A0153E;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            transition: background-color 0.3s ease;
        }

        .sort-buttons button:hover {
            background-color: #5D0E41;
        }

        .filters label {
            margin: 5px 0;
        }

        .filters output::after {
            content: '€';
        }

        .zoznam-peciv {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .pecivo {
            margin: 20px;
            text-align: center;
            border-color: #324E70;
        }
    </style>
</head>

<body>
    <div class="side-bar">
        <div class="sort-buttons">
            <form method="get" action="">
                <button type="submit" name="sort" value="cena">Triediť podľa ceny</button>
                <button type="submit" name="sort" value="gramaz">Triediť podľa gramáže</button>
                <button type="submit" name="sort" value="pecivo">Triediť podľa názvu</button>
            </form>
        </div>
        <div class="stats">
            <?php
            $servername = "localhost";
            $username = "rakus3a";
            $password = "Heslo123.";
            $dbname = "rakus3a";

            $connection = new mysqli($servername, $username, $password, $dbname);

            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            $sql_aggregate = "SELECT COUNT(*) AS count_products,
            MIN(cena) AS min_price,
            MAX(cena) AS max_price,
            ROUND(AVG(cena), 2) AS avg_price,
            SUM(gramaz) AS sum_gramaz
            FROM pecivo";

            $result_aggregate = $connection->query($sql_aggregate);

            if ($result_aggregate->num_rows > 0) {
                while ($row = $result_aggregate->fetch_assoc()) {
                    $count_products = $row['count_products'];
                    $min_price = $row['min_price'];
                    $max_price = $row['max_price'];
                    $avg_price = $row['avg_price'];
                    $sum_gramaz = $row['sum_gramaz'];
                }
            } else {
                $count_products = $min_price = $max_price = $avg_price = $sum_gramaz = 0;
            }

            $connection->close();

            echo "<p>Počet produktov: $count_products</p>";
            echo "<p>Minimálna cena: $min_price €</p>";
            echo "<p>Maximálna cena: $max_price €</p>";
            echo "<p>Priemerná cena: $avg_price €</p>";
            echo "<p>Celková gramáž: $sum_gramaz g</p>";
            ?>
        </div>
        <div class="filters">
            <form method="get" action="">
                <label for="price">Cena:</label>
                <input type="range" id="price" name="price" min="0" max="<?php echo $max_price; ?>" step="0.01" value="<?php echo isset($_GET['price']) ? $_GET['price'] : $max_price; ?>" oninput="this.nextElementSibling.value = this.value">
                <output><?php echo isset($_GET['price']) ? $_GET['price'] : $max_price; ?></output>

                <label for="type">Typ:</label>
                <select id="type" name="type">
                    <option value="0">Všetko</option>
                    <option value="1" <?php if(isset($_GET['type']) && $_GET['type'] == '1') echo 'selected'; ?>>Sladké</option>
                    <option value="2" <?php if(isset($_GET['type']) && $_GET['type'] == '2') echo 'selected'; ?>>Slané</option>
                </select>

                <button type="submit">Filtrovať</button>
            </form>
        </div>
    </div>
    <section class="zoznam-peciv">
        <?php
        $connection = new mysqli($servername, $username, $password, $dbname);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';

        $price_filter = isset($_GET['price']) ? floatval($_GET['price']) : $max_price;
        $type_filter = isset($_GET['type']) ? intval($_GET['type']) : 0;

        $sql = "SELECT pecivo.*, kategoria.typ_peciva FROM pecivo INNER JOIN kategoria ON pecivo.typ=kategoria.id";
        $filters = [];

        if ($price_filter < $max_price) {
            $filters[] = "pecivo.cena <= $price_filter";
        }

        if ($type_filter > 0) {
            $filters[] = "pecivo.typ = $type_filter";
        }

        if (count($filters) > 0) {
            $sql .= " WHERE " . implode(" AND ", $filters);
        }

        $sql .= " ORDER BY $sort";

        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="pecivo">';
                echo '<img src="'.$row["fotka"].'" alt="obrazok rohlika">';
                echo '<h2>'.$row["pecivo"].'</h2>';
                echo '<p>'.$row["predajca"].'</p>';
                echo '<p>Cena: '.$row["cena"].' €</p>';
                echo '<p>Gramáž: '.$row["gramaz"].' g</p>';
                echo '<p>Dátum výroby: '.$row["datum_vyroby"].'</p>';
                echo '<p>Dátum spotreby: '.$row["datum_spotreby"].'</p>';
                echo '<p>'.$row["typ_peciva"].'</p>';
                echo '</div>';
            }
        } else {
            echo "No results found";
        }

        $connection->close();
        ?>
    </section>
</body>
</html>
