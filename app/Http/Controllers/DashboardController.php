<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function __construct(public DashboardService $dashboardService)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/api/dashboard",
     *     tags={"Dashboard"},
     *     summary="Get Dashboard",
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json($this->dashboardService->getAll());
        } catch (Exception $e) {
            throw new HttpResponseException(
                response()->json([
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR)
            );
        }
    }

    public function customersIndex()
    {
        $currentRoute = request()->path();

        try {
            $result = $this->dashboardService->getCustomersData();
        } catch (Exception $e) {
            throw new HttpResponseException(
                response()->json([
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR)
            );
        }

        return response()->json($result);
    }

    public function salesOrdersIndex()
    {
        $currentRoute = request()->path();

        try {
            $result = $this->dashboardService->getSalesOrdersData();
        } catch (Exception $e) {
            throw new HttpResponseException(
                response()->json([
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR)
            );
        }

        return response()->json($result);
    }

    public function consumptionItemsIndex()
    {
        $currentRoute = request()->path();

        try {
            $result = $this->dashboardService->getConsumptionItemsData();
        } catch (Exception $e) {
            throw new HttpResponseException(
                response()->json([
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR)
            );
        }

        return response()->json($result);
    }

    public function stockAvailabilityIndex()
    {
        $currentRoute = request()->path();

        try {
            $result = $this->dashboardService->getStockAvailabilityData();
        } catch (Exception $e) {
            throw new HttpResponseException(
                response()->json([
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR)
            );
        }

        return response()->json($result);
    }

    public function downloadCustomersCSV()
    {
        try {
            $result = $this->dashboardService->exportCSVCustomersData();
        } catch (Exception $e) {
            throw new HttpResponseException(
                response()->json([
                    'status' => 500,
                    'message' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR)
            );
        }

        return $result;
    }

    public function downloadSalesOrdersCSV()
    {
        try {
            $result = $this->dashboardService->exportCSVSalesOrdersData();
        } catch (Exception $e) {
            throw new HttpResponseException(
                response()->json([
                    'status' => 500,
                    'message' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR)
            );
        }

        return $result;
    }

    public function downloadCSVConsumptionItems()
    {
        try {
            $result = $this->dashboardService->exportCSVConsumptionItemsData();
        } catch (Exception $e) {
            throw new HttpResponseException(
                response()->json([
                    'status' => 500,
                    'message' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR)
            );
        }

        return $result;
    }

    public function downloadCSVStockAvailability()
    {
        try {
            $result = $this->dashboardService->exportCSVStockAvailabilityData();
        } catch (Exception $e) {
            throw new HttpResponseException(
                response()->json([
                    'status' => 500,
                    'message' => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR)
            );
        }

        return $result;
    }
}
