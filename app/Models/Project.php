<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'client_id', 'title', 'description', 'budget_type',
        'budget_amount', 'status', 'deadline', 'attachments','freelancer_profile_id'
    ];
    protected $casts = [
    'attachments' => 'array',
    'deadline' => 'datetime',
    'budget_amount' => 'decimal:2'
];
protected $appends = [
    'budget_display',
    'deadline_status'
];
 public function getDeadlineStatusAttribute()
    {
        if (!$this->deadline) return null;

        return now()->gt($this->deadline)
            ? 'Expired'
            : now()->diffInDays($this->deadline) . ' days left';
    }
    public function getBudgetDisplayAttribute()
{
    return $this->budget_type === 'hourly'
        ? '$' . $this->budget_amount . '/hr'
        : '$' . $this->budget_amount;
}
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    public function scopeBudgetAbove($query, $amount)
    {
        return $query->where('budget_amount', '>=', $amount);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month);
    }
    public function client()
{
        return $this->belongsTo(User::class, 'client_id');
}
    public function tags()
{
        return $this->belongsToMany(Tag::class, 'project_tag');
}
public function offers()
{
    return $this->hasMany(Offer::class);
}
public function reviews()
{
    return $this->hasMany(Review::class);
}
public function attachments()
{
    return $this->hasMany(Attachment::class);
}
public function freelancerProfile()
{
    return $this->belongsTo(FreelancerProfile::class, 'freelancer_profile_id');
}
}
