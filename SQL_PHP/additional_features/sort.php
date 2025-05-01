<?php
// Default sort setup
$sort = $_GET['sort'] ?? 'id';
$order = ($_GET['order'] ?? 'asc') === 'desc' ? 'desc' : 'asc';

// Whitelist of sortable columns to prevent SQL injection
$allowedColumns = ['id', 'gender', 'age', 'hypertension', 'heart_disease', 'ever_married', 'work_type', 'residence_type', 'avg_glucose_level', 'bmi', 'smoking_status', 'stroke'];
if (!in_array($sort, $allowedColumns)) {
    $sort = 'id';
}

// Sorting link generator
function sort_column($label, $column, $currentSort, $currentOrder) {
    $order = ($currentSort === $column && $currentOrder === 'asc') ? 'desc' : 'asc';
    return "<a href=\"?sort=$column&order=$order\">$label</a>";
}
?>