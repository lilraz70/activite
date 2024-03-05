<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Collaborator extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['name', 'email','cnib','nip', 'phone', 'address', 'city', 'state', 'zip', 'country','region', 'company', 'activity_id', 'notes'];
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
