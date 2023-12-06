<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    //relazione con Projects
    public function projects(){
        return $this->hasMany(Project::class);
    }

    protected $fillable = [
        'name',
        'slug',
    ];
}
