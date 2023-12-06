<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $subject
 * @property string $body
 *
 * @property MailLog $mailLog
 */
class MailTemplate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['subject', 'body'];

    public function mailLog()
    {
        return $this->hasOne(MailLog::class, 'employee_id', 'id');
    }
}
