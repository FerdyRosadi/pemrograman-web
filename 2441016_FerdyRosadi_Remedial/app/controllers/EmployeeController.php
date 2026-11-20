<?php

class EmployeeController extends Controller
{
    private function validate(array $input): array
    {
        $errors = [];
        $data = [
            'nip' => trim((string) ($input['nip'] ?? '')),
            'name' => trim((string) ($input['name'] ?? '')),
            'department' => trim((string) ($input['department'] ?? '')),
            'position' => trim((string) ($input['position'] ?? '')),
            'salary' => trim((string) ($input['salary'] ?? '')),
        ];
        if ($data['nip'] === '') $errors['nip'] = 'NIP wajib diisi.';
        if ($data['name'] === '') $errors['name'] = 'Nama wajib diisi.';
        if ($data['department'] === '') $errors['department'] = 'Department wajib diisi.';
        if ($data['position'] === '') $errors['position'] = 'Position wajib diisi.';
        if ($data['salary'] === '' || !is_numeric($data['salary']) || (float) $data['salary'] < 0 || (float) $data['salary'] != (int) $data['salary']) {
            $errors['salary'] = 'Salary harus bilangan bulat >= 0.';
        }
        return [$data, $errors];
    }

    public function index(): void
    {
        $employees = (new Employee())->all();
        $this->view('employee/index', ['employees' => $employees, 'title' => 'Data Karyawan']);
    }

    public function create(): void
    {
        $this->view('employee/create', ['errors' => [], 'old' => ['nip' => '', 'name' => '', 'department' => '', 'position' => '', 'salary' => ''], 'title' => 'Tambah Karyawan']);
    }

    public function store(): void
    {
        [$data, $errors] = $this->validate($_POST);
        if ($errors !== []) {
            $this->view('employee/create', ['errors' => $errors, 'old' => $data, 'title' => 'Tambah Karyawan']);
            return;
        }
        try {
            (new Employee())->create($data);
        } catch (PDOException $e) {
            $errors['nip'] = 'NIP sudah dipakai / gagal menyimpan.';
            $this->view('employee/create', ['errors' => $errors, 'old' => $data, 'title' => 'Tambah Karyawan']);
            return;
        }
        $this->redirect('employees');
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $employee = (new Employee())->find($id);
        if ($employee === null) $this->redirect('employees');
        $this->view('employee/edit', ['errors' => [], 'old' => $employee, 'employee' => $employee, 'title' => 'Ubah Karyawan']);
    }

    public function update(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        $employee = (new Employee())->find($id);
        if ($employee === null) $this->redirect('employees');
        [$data, $errors] = $this->validate($_POST);
        if ($errors !== []) {
            $this->view('employee/edit', ['errors' => $errors, 'old' => array_merge($employee, $data), 'employee' => $employee, 'title' => 'Ubah Karyawan']);
            return;
        }
        (new Employee())->update($id, $data);
        $this->redirect('employees');
    }

    public function destroy(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) (new Employee())->delete($id);
        $this->redirect('employees');
    }
}