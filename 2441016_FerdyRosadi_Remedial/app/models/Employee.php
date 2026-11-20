<?php

class Employee extends Model
{
    protected string $table = 'employees';

    public function all(): array
    {
        $stmt = $this->db->query('SELECT id, nip, name, department, position, salary FROM employees ORDER BY id ASC');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT id, nip, name, department, position, salary FROM employees WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row === false ? null : $row;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare('INSERT INTO employees (nip, name, department, position, salary) VALUES (:nip, :name, :department, :position, :salary)');
        return $stmt->execute([
            'nip' => $data['nip'], 'name' => $data['name'],
            'department' => $data['department'], 'position' => $data['position'],
            'salary' => $data['salary'],
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare('UPDATE employees SET nip = :nip, name = :name, department = :department, position = :position, salary = :salary WHERE id = :id');
        return $stmt->execute([
            'id' => $id, 'nip' => $data['nip'], 'name' => $data['name'],
            'department' => $data['department'], 'position' => $data['position'],
            'salary' => $data['salary'],
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM employees WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}