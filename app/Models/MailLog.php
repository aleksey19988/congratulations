<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailLog extends Model
{
    use HasFactory;
    protected $table = 'mail_log';

    public function employee(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }

    public function mailTemplate(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(MailTemplate::class, 'id', 'mail_template_id');
    }
}
