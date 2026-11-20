<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ubah Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary shadow-sm">
    <div class="container"><span class="navbar-brand fw-bold">Employee Data</span></div>
</nav>
<main class="container py-4">
    <h3 class="fw-bold mb-3">Ubah Karyawan</h3>
    <?php if (!empty($errors)): ?>
    <div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div>
    <?php endif; ?>
    <div class="card border-0 shadow-sm"><div class="card-body">
        <form action="/employees/update" method="POST">
            <input type="hidden" name="id" value="<?= (int) ($employee['id'] ?? $old['id'] ?? 0) ?>">
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" id="nip" name="nip" class="form-control" value="<?= htmlspecialchars($old['nip'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($old['name'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" id="department" name="department" class="form-control" value="<?= htmlspecialchars($old['department'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" id="position" name="position" class="form-control" value="<?= htmlspecialchars($old['position'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="number" id="salary" name="salary" min="0" step="1" class="form-control" value="<?= (int) ($old['salary'] ?? 0) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/employees" class="btn btn-secondary">Batal</a>
        </form>
    </div></div>
</main>
</body>
</html>