<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'comments';

    protected $fillable = [
        'commentator_id',
        'post_id',
        'comment_content',
        'comment_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
