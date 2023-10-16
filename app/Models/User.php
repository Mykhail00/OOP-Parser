<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class User extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create(string $user): int
    {

        $stmt = $this->db->prepare(
            'INSERT INTO users(full_name)
                VALUES(?)'
        );
        $stmt->execute([$user]);

        return (int) $this->db->lastInsertId();
    }
}