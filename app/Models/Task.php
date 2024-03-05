<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['name', 'description', 'activity_id'];
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
    public function risks()
    {
        return $this->hasMany(Risk::class);
    }
}
