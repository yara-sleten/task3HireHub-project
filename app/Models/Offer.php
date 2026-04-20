<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected $fillable = [
        'project_id',
        'freelancer_id',
        'proposed_price',
        'delivery_time',
        'cover_letter',
        'status'
    ];

    protected $casts = [
        'proposed_price' => 'decimal:2',
        'delivery_time' => 'integer',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
