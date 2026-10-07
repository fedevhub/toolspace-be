<?php

namespace App\Services;

use App\Repositories\DashboardRepository;

class DashboardService
{
    private DashboardRepository $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function getDashboardData()
    {
        return $this->dashboardRepository->getDashboardData();
    }
}