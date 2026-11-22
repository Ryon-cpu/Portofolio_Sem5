<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioContent extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'content'];

    public $incrementing = false;

    protected $keyType = 'string';

    protected function casts(): array
    {
        return [
            'content' => 'array',
        ];
    }
}
