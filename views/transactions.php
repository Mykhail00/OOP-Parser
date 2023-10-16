<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <!-- TODO -->

                <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td><?= \App\FormatClass::formatDate($transaction['date']) ?></td>
                    <td><?= $transaction['check'] ?></td>
                    <td><?= $transaction['description'] ?></td>
                    <td>
                        <?php if ($transaction['amount'] > 0): ?>
                            <sapn style="color:green">
                                <?= \App\FormatClass::formatAmount($transaction['amount'])?>
                            </sapn>
                        <?php elseif ($transaction['amount'] < 0): ?>
                            <span style="color:red">
                                <?= \App\FormatClass::formatAmount($transaction['amount'])?>
                            </span>
                        <?php else: ?>
                            <?= \App\FormatClass::formatAmount($transaction['amount'])?>
                        <?php endif ?>
                    </td>
                </tr>
                <?php endforeach ?>

            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td><?=\App\FormatClass::formatAmount($totals['total_income']); ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td><?=\App\FormatClass::formatAmount($totals['total_expense']); ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><?=\App\FormatClass::formatAmount($totals['net_total']); ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>