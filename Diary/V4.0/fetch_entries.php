<?php
require 'db.php';

$sql = "SELECT u.first_name AS uploader, d.entry_timestamp AS date, d.description, d.coworker
        FROM diary_entry d 
        JOIN user_diary ud ON d.entry_id = ud.entry_id
        JOIN user_data u ON ud.user_id = u.user_id";
$stmt = $pdo->query($sql);
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
