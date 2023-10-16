<?php

declare(strict_types=1);

namespace App\Controllers;

use App\FilesReader;
use App\Models\DatabaseUploader;
use App\StorageUploader;
use App\View;

class UploadController
{
    public function index(): View
    {
        return View::make('upload/index');
    }

    // Uploads files into storage and DB
    public function upload(): View
    {
        // Store transactions file in the storage folder
        StorageUploader::make()->doUpload();
        $filesReader = new FilesReader();
        $filesArray = $filesReader->readFiles();

        $transactionsArray = $filesReader->readTransactionsIntoArray($filesArray);

        // Generate random user (for demonstration purpose only)
        $user = 'User' . rand(0, 100);

        // Store transactions in DB
        (new DatabaseUploader())->updateDatabase($user, $transactionsArray);

        return View::make('success');
    }
}