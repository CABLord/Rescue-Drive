<?php
require 'db.php';

$sql = "SELECT u.user_id, d.entry_id, u.first_name AS uploader, 
        d.entry_timestamp AS date, d.description, d.coworker, d.title
        FROM diary_entry d 
        JOIN user_diary ud ON d.entry_id = ud.entry_id
        JOIN user_data u ON ud.user_id = u.user_id
        ORDER BY d.entry_timestamp ASC";

$stmt = $pdo->query($sql);
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
