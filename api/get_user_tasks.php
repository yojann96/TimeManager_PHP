<?php
header('Content-Type: application/json');
require '../config/db.php';

if (!isset($_GET['user_id'])) {
    echo json_encode(["error" => "User ID is required"]);
    exit;
}

$userId = intval($_GET['user_id']);
$sql = "
    SELECT 
        A.id AS task_id,
        A.description AS task_description,
        format(A.hours_worked, 2) AS hours_worked,
        B.name AS project_name,
        format( C.rate, 2) as rate,
        format(  (A.hours_worked * C.rate), 2) AS total_value
    FROM tasks AS A
    INNER JOIN projects  AS B
		ON A.project_id = B.id
    INNER JOIN  user_project_rates as C
		ON A.project_id = C.project_id
        AND A.user_id = C.user_id
    WHERE A.user_id = ?
    ORDER BY A.created_at DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
