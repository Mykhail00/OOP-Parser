<?php

declare(strict_types=1);

namespace App;

class FilesReader
{
    public function __construct(protected ?string $storage = null)
    {
        $this->storage = $storage ?? STORAGE_PATH;
    }

    // Reads files from storage into array of files
    public function readFiles(): array
    {
        $files = [];
        foreach (scandir(STORAGE_PATH) as $file) {
            if (is_file(STORAGE_PATH . '/' . $file) && str_ends_with(STORAGE_PATH . '.' . $file, '.csv')) {
                $files[] = STORAGE_PATH . '/' . $file;
            }
        }
        return $files;
    }

    // Reads csv file into array
    public function readCsvIntoArray(string $filename): array
    {
        if (!file_exists($filename)) {
            echo 'File does not exist';
            return [];
        }

        $transactions = [];
        $file = fopen($filename, 'r');
        fgetcsv($file);

        while (($transaction = fgetcsv($file)) !== false) {
            $transactions[] = $transaction;
        }

        return $transactions;
    }


    // Read transactions files into array to uploaded in DB
    public function readTransactionsIntoArray(array $filesArray): array
    {
        // Read files with transactions into array of transactions
        $transactionsArray = [];
        foreach ($filesArray as $file) {
            $transactionsArray = $this->readCsvIntoArray($file);
        }

        // Preparing transactions for storage in DB
        $formedTransactionsArray = [];
        foreach ($transactionsArray as $transaction)
        {
            [$date, $check, $description, $amount] = $transaction;
            $amount = (float) str_replace(['$', ','], '', $amount);
            $date = \DateTime::createFromFormat('m/d/Y', $date)->getTimestamp();

            $formedTransactionsArray[] = [
                'date' => $date,
                'check' => $check,
                'description' => $description,
                'amount' => $amount,
            ];
        }

        return $formedTransactionsArray;
    }
}