<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['tasks'];

    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'description', 'deadline', 'user_id', 'client_id'];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function client()
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class)->withTrashed();
    }
}
