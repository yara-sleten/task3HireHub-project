<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RecalculateFreelancerRatingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public $freelancerProfile) {}

    public function handle(): void
    {
        $avg = $this->freelancerProfile
            ->reviews()
            ->avg('rating');

        $this->freelancerProfile->update([
            'rating' => $avg
        ]);

        logger(" Rating updated for freelancer ID: " . $this->freelancerProfile->id);
    }
}
