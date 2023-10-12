<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\UploadFailureException;

class Uploader
{
    public string $fileName;
    protected string $filePath;

    public function __construct()
    {
        $this->fileName = $_FILES['csv_file']['name'];
        $this->filePath = STORAGE_PATH.'/'.$this->fileName;
    }

    // Return static instead of self to allow late static binding in subclasses
    public static function make(): static
    {
        return new static();
    }
    public function doUpload(): void
    {
        // Provide some file validation before uploading
        try {
            if ($_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
                throw new UploadFailureException('upload error');
            }

            if (!str_ends_with($this->fileName, '.csv')) {
                throw new UploadFailureException('only .csv file allowed');
            }

            move_uploaded_file($_FILES['csv_file']['tmp_name'], $this->filePath);

            echo 'File Uploaded';

        } catch (UploadFailureException $e) {
            echo 'Failed to upload : '.$e->getMessage();
        }
    }
}