<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost", "logger", "paswoord", "temperatures");
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "DB error"]);
    exit;
}

$sql = "
    SELECT dateandtime, temperature, humidity
    FROM temperaturedata
    ORDER BY dateandtime ASC
";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$conn->close();
echo json_encode($data);
