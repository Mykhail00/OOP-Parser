<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Uploader;
use App\View;

class UploadController
{
    public function index(): View
    {
        return View::make('upload/index');
    }

    public function upload(): void
    {
        Uploader::make()->doUpload();
    }
}