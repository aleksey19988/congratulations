<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $patronymic
 * @property string $birthday
 * @property string $email
 * @property int $position_id
 *
 * @property Position $position
 */
class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'birthday',
        'email',
        'position_id',
    ];

    public function getFullName(): string
    {
        $nameAndLastname = "$this->first_name $this->last_name";

        if (isset($this->patronymic)) {
            return "$nameAndLastname $this->patronymic";
        }

        return $nameAndLastname;
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function mailLog()
    {
        return $this->hasOne(MailLog::class, 'employee_id', 'id');
    }
}
