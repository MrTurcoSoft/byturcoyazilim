<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'company', 'project_type', 'project_description',
        'budget_range', 'timeline', 'preferred_date', 'preferred_time', 'wants_meeting',
        'status', 'admin_notes', 'quoted_amount', 'calendar_event_id', 'meet_link'
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'quoted_amount' => 'decimal:2',
        'wants_meeting' => 'boolean',
    ];
}
