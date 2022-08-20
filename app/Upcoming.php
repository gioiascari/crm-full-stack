<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Factories\HasFactory;

class Upcoming extends Model
{
    use HasFactory;

    protected $fillable = ['title','completed','approved', 'taskId', 'waiting'];
}
