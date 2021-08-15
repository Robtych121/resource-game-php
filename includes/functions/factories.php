<?php

function getFactories($uid){
    include 'includes/config/db_connection.php';
    $out ="";
	$stmt = $conn->prepare('SELECT factory_name FROM factories WHERE user_id = ?');
    $stmt -> bind_param('i', $uid);
    $stmt -> execute();
	$stmt -> bind_result($factory_name);

	while($stmt -> fetch()){

        $out .= "
                <tr>
                    <td>$factory_name</td>
                ";
        $out .= "</tr>";
	}

	return $out;
	exit();
}
?>