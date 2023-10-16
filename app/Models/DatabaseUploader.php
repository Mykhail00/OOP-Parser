<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class DatabaseUploader extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Insert new user and transactions into DB
    public function updateDatabase(string $user, array $transactions): void
    {
        $userModel = new User();
        $transactionsModel = new Transactions();

        try{
            $this->db->beginTransaction();

            $userId = $userModel->create($user);
            $transactionsModel->uploadTransactions($userId, $transactions);

            $this->db->commit();
        } catch (\Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            throw new \Exception($e->getMessage());
        }
    }
}