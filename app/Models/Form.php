<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Form
 * @package App\Models
 *
 * @property integer $id
 * @property string $page_uid
 * @property string $name
 * @property string $phone
 * @property string $email
 *
 */
class Form extends Model
{
    use HasFactory;

    /**
     * Properties allowed for mass assigment
     *
     * @var array $fillable
     */
    protected $fillable = [
        'page_uid',
        'name',
        'phone',
        'email'
    ];
}
