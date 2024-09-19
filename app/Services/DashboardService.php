<?php

namespace App\Services;

use App\Repositories\DashboardRepository;

class DashboardService
{
    public function __construct(public DashboardRepository $dashboardRepository)
    {
        //
    }

    public function getAll(): array
    {
        return [
            'message' => 'Data retrieved successfully!',
            'success' => true,
            'status' => 200,
            'dashboard' => $this->dashboardRepository->getAll()
        ];
    }

    public function getCustomersData()
    {
        return $this->dashboardRepository->getCustomers();
    }

    public function getSalesOrdersData()
    {
        return $this->dashboardRepository->getSalesOrders();
    }

    public function getConsumptionItemsData()
    {
        return $this->dashboardRepository->getConsumptionItems();
    }

    public function getStockAvailabilityData()
    {
        return $this->dashboardRepository->getStockAvailability();
    }

    public function exportCSVCustomersData()
    {
        return $this->dashboardRepository->exportCSVCustomers();
    }

    public function exportCSVSalesOrdersData()
    {
        return $this->dashboardRepository->exportCSVSalesOrders();
    }

    public function exportCSVConsumptionItemsData()
    {
        return $this->dashboardRepository->exportCSVConsumptionItems();
    }

    public function exportCSVStockAvailabilityData()
    {
        return $this->dashboardRepository->exportCSVStockAvailability();
    }
}
