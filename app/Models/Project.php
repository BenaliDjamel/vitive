<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'name',
        'creator_id',
        'dueDate',
        'owner_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->hasOne(User::class);
    }
}
