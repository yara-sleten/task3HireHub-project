<?php
namespace App\Services;

use App\Models\User;
use App\Models\Project;
use App\Models\Offer;

class DashboardService
{
    public function stats()
    {
        return [
            'users_count' => User::count(),
            'projects_count' => Project::count(),
            'offers_count' => Offer::count(),
            'total_offers_value' => Offer::sum('proposed_price'),
        ];
    }
}