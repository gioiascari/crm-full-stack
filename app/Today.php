<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Factories\HasFactory;

class Today extends Model
{
    use HasFactory;

    protected $fillable = ['title','completed','approved', 'taskId'];
}
