<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Data Karyawan</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary shadow-sm">
        <div class="container">
            <span class="navbar-brand fw-bold">Data Karyawan</span>
        </div>
    </nav>
<main class="container py-4">
    <h3 class="fw-bold mb-3">Data Karyawan</h3>
    <a href="/employees/create" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i> Tambah Karyawan</a>
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Department</th>
                        <th scope="col">Position</th>
                        <th scope="col">Salary</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $index => $employee): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($employee['nip']) ?></td>
                        <td><?= htmlspecialchars($employee['name']) ?></td>
                        <td><?= htmlspecialchars($employee['department']) ?></td>
                        <td><?= htmlspecialchars($employee['position']) ?></td>
                        <td><?= number_format((float) $employee['salary'], 0, ',', '.') ?></td>
                        <td class="text-center">
                            <a href="/employees/edit?id=<?= (int) $employee['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Ubah</a>
                            <form action="/employees/delete" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus karyawan ini?');">
                                <input type="hidden" name="id" value="<?= (int) $employee['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>
</html>