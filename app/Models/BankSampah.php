<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankSampah extends Model
{
    use HasFactory;

    protected $table = 'bank_sampahs';

    protected $fillable = [
        'code',
        'name',
        'address',
        'phone',
        'operating_hours',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
