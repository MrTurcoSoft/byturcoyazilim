<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'company', 'project_type', 'project_description',
        'budget_range', 'timeline', 'preferred_date', 'preferred_time', 'status',
        'admin_notes', 'quoted_amount'
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'quoted_amount' => 'decimal:2',
    ];
}
