<?php

namespace App\Models\forms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualCongratulationForm extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'mail_template_id',
        'company_name',
    ];
}
