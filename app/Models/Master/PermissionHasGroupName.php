<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionHasGroupName extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'permission_has_group_name'; 

    protected $fillable = [
        'name',
    ];
}
