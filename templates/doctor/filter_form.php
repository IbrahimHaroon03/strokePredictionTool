<link rel="stylesheet" href="../../static/filter_styles.css">

<form method="GET" class="filter-form">
    <label>ID: <input type="number" name="id" value="<?= htmlspecialchars($_GET['id'] ?? '') ?>"></label>

    <label>Gender: 
        <select name="gender">
            <option value="">All</option>
            <option value="Male" <?= ($_GET['gender'] ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= ($_GET['gender'] ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
        </select>
    </label>

    <label>Age: <input type="number" name="age" value="<?= htmlspecialchars($_GET['age'] ?? '') ?>"></label>

    <label>Hypertension:
        <select name="hypertension">
            <option value="">All</option>
            <option value="1" <?= ($_GET['hypertension'] ?? '') === '1' ? 'selected' : '' ?>>Yes</option>
            <option value="0" <?= ($_GET['hypertension'] ?? '') === '0' ? 'selected' : '' ?>>No</option>
        </select>
    </label>

    <label>Heart Disease:
        <select name="heart_disease">
            <option value="">All</option>
            <option value="1" <?= ($_GET['heart_disease'] ?? '') === '1' ? 'selected' : '' ?>>Yes</option>
            <option value="0" <?= ($_GET['heart_disease'] ?? '') === '0' ? 'selected' : '' ?>>No</option>
        </select>
    </label>

    <label>Married:
        <select name="ever_married">
            <option value="">All</option>
            <option value="Yes" <?= ($_GET['ever_married'] ?? '') === 'Yes' ? 'selected' : '' ?>>Yes</option>
            <option value="No" <?= ($_GET['ever_married'] ?? '') === 'No' ? 'selected' : '' ?>>No</option>
        </select>
    </label>

    <label>Work Type:
        <select name="work_type">
            <option value="">All</option>
            <?php foreach (['children', 'govt_job', 'never_worked', 'private', 'self-employed'] as $type): ?>
                <option value="<?= $type ?>" <?= ($_GET['work_type'] ?? '') === $type ? 'selected' : '' ?>><?= $type ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>Residence:
        <select name="residence_type">
            <option value="">All</option>
            <option value="Rural" <?= ($_GET['residence_type'] ?? '') === 'Rural' ? 'selected' : '' ?>>Rural</option>
            <option value="Urban" <?= ($_GET['residence_type'] ?? '') === 'Urban' ? 'selected' : '' ?>>Urban</option>
        </select>
    </label>

    <label>Glucose Level: <input type="number" name="avg_glucose_level" value="<?= htmlspecialchars($_GET['avg_glucose_level'] ?? '') ?>"></label>

    <label>BMI: <input type="number" name="bmi" value="<?= htmlspecialchars($_GET['bmi'] ?? '') ?>"></label>

    <label>Smoking:
        <select name="smoking_status">
            <option value="">All</option>
            <?php foreach (['formerly_smoked', 'never_smoked', 'smokes', 'unknown'] as $smoke): ?>
                <option value="<?= $smoke ?>" <?= ($_GET['smoking_status'] ?? '') === $smoke ? 'selected' : '' ?>><?= $smoke ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>Stroke Likelihood: <input type="number" name="stroke" value="<?= htmlspecialchars($_GET['stroke'] ?? '') ?>"></label>

    <div class="button-group">
        <button type="submit">Filter</button>
        <a href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>" class="reset-button">Reset</a>
    </div>


</form>
