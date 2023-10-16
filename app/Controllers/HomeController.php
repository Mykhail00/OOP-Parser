<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Transactions;
use App\View;

class HomeController
{
    public function index(): View
    {
        return View::make('index');
    }

    // Display transactions from DB
    public function transactions(): View
    {
        $transactions = (new Transactions())->find();

        $totals = Transactions::calculateTotals($transactions);

        return View::make('transactions', [
            'transactions' => $transactions,
            'totals' => $totals
        ]);
    }
}