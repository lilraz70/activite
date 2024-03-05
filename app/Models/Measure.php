<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Measure extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'description', 'risk_id'];

    public function risk()
    {
        return $this->belongsTo(Risk::class);
    }
}
