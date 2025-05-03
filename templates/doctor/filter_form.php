<link rel="stylesheet" href="../../static/filter_styles.css">

<form method="GET" class="filter-form">
    <div class="filter-item">
        <label for="id">ID</label>
        <input type="number" name="id" id="id" value="<?= htmlspecialchars($_GET['id'] ?? '') ?>">
    </div>

    <div class="filter-item">
        <label for="gender">Gender</label>
        <select name="gender" id="gender">
            <option value="">All</option>
            <option value="Male" <?= ($_GET['gender'] ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= ($_GET['gender'] ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
        </select>
    </div>

    <div class="filter-item">
        <label for="age">Age</label>
        <input type="number" name="age" id="age" value="<?= htmlspecialchars($_GET['age'] ?? '') ?>">
    </div>

    <div class="filter-item">
        <label for="hypertension">Hypertension</label>
        <select name="hypertension" id="hypertension">
            <option value="">All</option>
            <option value="1" <?= ($_GET['hypertension'] ?? '') === '1' ? 'selected' : '' ?>>Yes</option>
            <option value="0" <?= ($_GET['hypertension'] ?? '') === '0' ? 'selected' : '' ?>>No</option>
        </select>
    </div>

    <div class="filter-item">
        <label for="heart_disease">Heart Disease</label>
        <select name="heart_disease" id="heart_disease">
            <option value="">All</option>
            <option value="1" <?= ($_GET['heart_disease'] ?? '') === '1' ? 'selected' : '' ?>>Yes</option>
            <option value="0" <?= ($_GET['heart_disease'] ?? '') === '0' ? 'selected' : '' ?>>No</option>
        </select>
    </div>

    <div class="filter-item">
        <label for="ever_married">Married</label>
        <select name="ever_married" id="ever_married">
            <option value="">All</option>
            <option value="Yes" <?= ($_GET['ever_married'] ?? '') === 'Yes' ? 'selected' : '' ?>>Yes</option>
            <option value="No" <?= ($_GET['ever_married'] ?? '') === 'No' ? 'selected' : '' ?>>No</option>
        </select>
    </div>

    <div class="filter-item">
        <label for="work_type">Work Type</label>
        <select name="work_type" id="work_type">
            <option value="">All</option>
            <?php foreach (['children', 'govt_job', 'never_worked', 'private', 'self-employed'] as $type): ?>
                <option value="<?= $type ?>" <?= ($_GET['work_type'] ?? '') === $type ? 'selected' : '' ?>><?= $type ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="filter-item">
        <label for="residence_type">Residence</label>
        <select name="residence_type" id="residence_type">
            <option value="">All</option>
            <option value="Rural" <?= ($_GET['residence_type'] ?? '') === 'Rural' ? 'selected' : '' ?>>Rural</option>
            <option value="Urban" <?= ($_GET['residence_type'] ?? '') === 'Urban' ? 'selected' : '' ?>>Urban</option>
        </select>
    </div>

    <div class="filter-item">
        <label for="avg_glucose_level">Glucose Level</label>
        <input type="number" name="avg_glucose_level" id="avg_glucose_level" value="<?= htmlspecialchars($_GET['avg_glucose_level'] ?? '') ?>">
    </div>

    <div class="filter-item">
        <label for="bmi">BMI</label>
        <input type="number" name="bmi" id="bmi" value="<?= htmlspecialchars($_GET['bmi'] ?? '') ?>">
    </div>

    <div class="filter-item">
        <label for="smoking_status">Smoking</label>
        <select name="smoking_status" id="smoking_status">
            <option value="">All</option>
            <?php foreach (['formerly_smoked', 'never_smoked', 'smokes', 'unknown'] as $smoke): ?>
                <option value="<?= $smoke ?>" <?= ($_GET['smoking_status'] ?? '') === $smoke ? 'selected' : '' ?>><?= $smoke ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="filter-item">
        <label for="stroke">Stroke Likelihood</label>
        <input type="number" name="stroke" id="stroke" value="<?= htmlspecialchars($_GET['stroke'] ?? '') ?>">
    </div>

    <div class="button-group">
        <button type="submit">Filter</button>
        <a href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>" class="reset-button">Reset</a>
    </div>
</form>
