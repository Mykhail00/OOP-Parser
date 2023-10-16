<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class Transactions extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function uploadTransactions(int $userId, array $transactions): void
    {
        try {
            $stmt = $this->db->prepare(
                'INSERT INTO transactions(user_id, `date`, `check`, description, amount)
            VALUES (?, ?, ?, ?, ?)'
            );

            foreach ($transactions as $transaction) {
                $stmt->execute([
                    $userId,
                    $transaction['date'],
                    $transaction['check'],
                    $transaction['description'],
                    $transaction['amount']
                ]);
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

    }

    // Return transactions of user (default userId = 1 hardcoded)
    public function find(int $userId = 1): array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM transactions
        WHERE user_id = ?'
        );

        $stmt->execute([$userId]);

        $transactions = $stmt->fetchAll();

        return $transactions ?? [];
    }

    // Static method to calculate transactions totals
    public static function calculateTotals(array $transactions): array
    {
        $totals = ['net_total' => 0, 'total_income' => 0, 'total_expense' => 0];

        foreach ($transactions as $transaction) {
            $totals['net_total'] += $transaction['amount'];

            if ($transaction['amount'] >= 0) {
                $totals['total_income'] += $transaction['amount'];
            } else {
                $totals['total_expense'] += $transaction['amount'];
            }
        }

        return $totals ?? [];
    }
}