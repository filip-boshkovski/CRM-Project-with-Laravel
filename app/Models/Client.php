<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['projects'];

    protected $dates = ['deleted_at'];

    protected $fillable = ['company', 'city', 'VAT', 'address'];

    public function projects()
    {
        return $this->hasMany(Project::class)->withTrashed();
    }
}
