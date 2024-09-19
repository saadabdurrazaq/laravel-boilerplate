<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
        'author_id',
        'post_title',
        'post_content',
        'post_excerpt',
        'post_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
