<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;
    //relazione con Types, nome funzione al singolare perchè il project ha un solo type
    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }

    protected $fillable = [
        'title',
        'type_id',
        'slug',
        'description',
        'image',
        'image_original_name',
        'github_link',
        'other_developers',
    ];

}
