<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 */
class Position extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];

    public function employees(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
