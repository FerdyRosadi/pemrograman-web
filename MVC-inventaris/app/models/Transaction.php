<?php

class Transaction extends Model
{
    protected string $table = 'transactions';

   public function all(): array
{
    return $this->db->query(
        "SELECT t.*, u.full_name AS user_name
         FROM transactions t
         LEFT JOIN users u ON t.user_id = u.id
         ORDER BY t.created_at DESC, t.id DESC"
    )->fetchAll();
}

    public function create(array $data): bool
{
    // Cari barangnya dulu, untuk stok dan untuk salinan nama
    $itemStmt = $this->db->prepare("SELECT code, name, unit FROM items WHERE id = :item_id");
    $itemStmt->execute([':item_id' => $data['item_id']]);
    $item = $itemStmt->fetch();
    if (!$item) {
        return false;
    }

    try {
        $this->db->beginTransaction();

        // Simpan riwayat dengan NAMA, bukan dengan item_id
        $this->db->prepare(
            "INSERT INTO transactions (user_id, type, quantity, notes, item_code, item_name, item_unit)
             VALUES (:user_id, :type, :quantity, :notes, :item_code, :item_name, :item_unit)"
        )->execute([
            ':user_id' => $data['user_id'],
            ':type' => $data['type'],
            ':quantity' => $data['quantity'],
            ':notes' => $data['notes'] ?? null,
            ':item_code' => $item['code'],
            ':item_name' => $item['name'],
            ':item_unit' => $item['unit'],
        ]);

        // Update stok barang yang bersangkutan, seperti biasa
        $op = ($data['type'] === 'IN') ? '+' : '-';
        $this->db->prepare("UPDATE items SET quantity = quantity {$op} :quantity WHERE id = :item_id")
            ->execute([':quantity' => $data['quantity'], ':item_id' => $data['item_id']]);

        $check = $this->db->prepare("SELECT quantity FROM items WHERE id = :item_id");
        $check->execute([':item_id' => $data['item_id']]);
        if ((int) $check->fetchColumn() < 0) {
            $this->db->rollBack();
            return false;
        }

        $this->db->commit();
        return true;
    } catch (PDOException $e) {
        if ($this->db->inTransaction()) {
            $this->db->rollBack();
        }
        return false;
    }
}

    public function recent(int $limit = 5): array
{
    $stmt = $this->db->prepare(
        "SELECT t.*, u.full_name AS user_name
         FROM transactions t
         LEFT JOIN users u ON t.user_id = u.id
         ORDER BY t.created_at DESC, t.id DESC LIMIT :limit");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}


    public function todayCount(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM transactions WHERE DATE(created_at) = CURDATE()")->fetchColumn();
    }
}
