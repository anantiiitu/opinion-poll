<?php

require 'poll_model.php';

$model = new poll_model();

if (count($_POST) == 1) {

    echo "<script>alert('You did not vote!');</script>";

}

if (count($_POST) > 1) {

    $ts = date("Y-m-d H:i:s");

    $option = $_POST['vote'][0];

    $sql_stmt = "INSERT INTO opinion_poll (`choice`,`ts`) VALUES ($option,'$ts')";

    $model->insert($sql_stmt);

    $sql_stmt = "SELECT COUNT(choice) choices_count FROM opinion_poll;";

    $choices_count = $model->select($sql_stmt);

    $libraries = array("", "Miguel de Cervantes", "Charles Dickens", "J.R.R. Tolkien", "Antoine de Saint-Exuper");

    $table_rows = '';

    for ($i = 1; $i < 5; $i++) {

        $sql_stmt = "SELECT COUNT(choice) choices_count FROM opinion_poll WHERE choice = $i;";

        $result = $model->select($sql_stmt);

        $table_rows .= "<tr><td>" . $ libraries [$i] . " Got:</td><td><b>" . $result[0] . "</b> votes</td></tr>";

    }

    require 'results.html.php';

    exit;

}

require 'opinion.html.php';

?>
