<?php
$where = [];

if (!empty($_GET['id'])) $where[] = "id = " . (int)$_GET['id'];
if (!empty($_GET['gender'])) $where[] = "gender = '" . $conn->real_escape_string($_GET['gender']) . "'";
if (!empty($_GET['age'])) $where[] = "age = " . (int)$_GET['age'];
if (isset($_GET['hypertension']) && $_GET['hypertension'] !== '') $where[] = "hypertension = " . (int)$_GET['hypertension'];
if (isset($_GET['heart_disease']) && $_GET['heart_disease'] !== '') $where[] = "heart_disease = " . (int)$_GET['heart_disease'];
if (!empty($_GET['ever_married'])) $where[] = "ever_married = '" . $conn->real_escape_string($_GET['ever_married']) . "'";
if (!empty($_GET['work_type'])) $where[] = "work_type = '" . $conn->real_escape_string($_GET['work_type']) . "'";
if (!empty($_GET['residence_type'])) $where[] = "residence_type = '" . $conn->real_escape_string($_GET['residence_type']) . "'";
if (!empty($_GET['avg_glucose_level'])) $where[] = "avg_glucose_level = " . (int)$_GET['avg_glucose_level'];
if (!empty($_GET['bmi'])) $where[] = "bmi = " . (int)$_GET['bmi'];
if (!empty($_GET['smoking_status'])) $where[] = "smoking_status = '" . $conn->real_escape_string($_GET['smoking_status']) . "'";
if (!empty($_GET['stroke'])) $where[] = "stroke = " . (int)$_GET['stroke'];

$where_clause = $where ? 'WHERE ' . implode(' AND ', $where) : '';
