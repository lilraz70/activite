<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['name', 'description', 'task_id'];
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    public function measures()
    {
        return $this->hasMany(Measure::class);
    }
}
