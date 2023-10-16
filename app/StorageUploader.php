<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\UploadFailureException;

class StorageUploader
{
    public string $fileName;
    protected string $filePath;

    public function __construct()
    {
        $this->fileName = $_FILES['csv_file']['name'];
        $this->filePath = STORAGE_PATH.'/'.'file.csv';
    }


    public static function make(): self
    {
        return new self();
    }
    public function doUpload(): void
    {
        // Provide some file validation before uploading
        try {
            if ($_FILES['csv_file']['error'] == UPLOAD_ERR_NO_FILE) {
                echo 'Provide file';
                exit();
            }

            elseif (!str_ends_with($this->fileName, '.csv')) {
                echo 'Only .csv files allowed';
                exit();
            }

            elseif ($_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
                throw new UploadFailureException('Upload error :'.$_FILES['csv_file']['error']);
            }

            move_uploaded_file($_FILES['csv_file']['tmp_name'], $this->filePath);

        } catch (UploadFailureException) {
            echo 'Failed to upload';
            exit();
        }
    }
}