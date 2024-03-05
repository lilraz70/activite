<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Activity extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['name', 'description'];
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function collaborators()
    {
        return $this->hasMany(Collaborator::class);
    }
}
