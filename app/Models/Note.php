<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'uuid';
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
