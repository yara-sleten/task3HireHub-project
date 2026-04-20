<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerProfile extends Model
{
    protected $fillable = [
        'user_id', 'bio', 'hourly_rate', 'phone',
        'avatar', 'availability', 'is_verified', 'portfolio_url'
    ];
    protected $casts = [
        'is_verified' => 'boolean',
        'hourly_rate' => 'decimal:2',
    ];
    protected $appends = [
        'full_name',
        'avatar_url',
        'rating',
        'member_since'
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }

   public function offers()
{
    return $this->hasMany(Offer::class, 'freelancer_id', 'user_id');
}
    public function reviews()
    {
        return $this->hasMany(Review::class, 'freelancer_profile_id');
    }
public function skills()
{
    return $this->belongsToMany(Skill::class, 'freelancer_skill')
        ->withPivot('years_of_experience');
}
    //  Accessor: Full Name
    public function getFullNameAttribute()
    {
        return $this->user?->name;
    }

    // Accessor: Avatar
    public function getAvatarUrlAttribute()
    {
        return $this->avatar
           ? asset('storage/' . $this->avatar)
           : asset('default-avatar.png');
    }

    // Accessor: Rating
    public function getRatingAttribute()
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }

    //  Accessor: Member Since
   public function getMemberSinceAttribute()
{
    if (!$this->created_at) {
        return 'Member since N/A';
    }

    return 'Member since ' . \Carbon\Carbon::parse($this->created_at)->format('F Y');
}

    // Scope: Available
    public function scopeAvailable($query)
    {
        return $query->where('availability', 'available');
    }

    //  Scope: Verified
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    // Scope: Top Rated
    public function scopeTopRated($query)
    {
        return $query->withAvg('reviews', 'rating')
                     ->orderByDesc('reviews_avg_rating');
    }

}
