<?php

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\LengthAwarePaginator as PaginationLengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;

function checkRole()
{
    $role = DB::table('model_has_roles')
        ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->where('model_id', auth()->id())
        ->selectRaw('
            roles.id as role_id,
            roles.name as role_name
        ')
        ->first();

    return $role;
}

function addNumberEachRowOnGet(Collection $rows)
{
    $rows = $rows->map(function ($row, $index) {
        if (gettype($row) == 'object') {
            $row->row_number = $index + 1;
        } else {
            $row['row_number'] = (int)$index + 1;
        }

        return $row;
    });

    return $rows;
}

function addNumberEachRowOnPagination(PaginationLengthAwarePaginator $rows)
{
    $rows->getCollection()->transform(function ($row, $key) use ($rows) {
        $row->row_number = ($rows->currentPage() - 1) * $rows->perPage() + $key + 1;
        return $row;
    });
    return $rows;
}

function formatNumberRupiah(?float $number = 0, int $decimal = 0, $decimal_separator = ',', $thousand_separator = '.'): string
{
    return number_format($number, $decimal, $decimal_separator, $thousand_separator);
}

function formatTranslatedDateDMY(string $date): string
{
    return Carbon::parse($date)->translatedFormat('d M Y');
}

function getIndexModule(Builder $moduleBuilder): object
{
    return $moduleBuilder->get();
}

function paginateIndexModule(Builder $moduleBuilder): PaginationLengthAwarePaginator
{
    return $moduleBuilder->paginate(request('per_page', 10));
}

function formatDateYMD(string $date): string
{
    return Carbon::parse($date)->format('Y-m-d');
}

function getPaginatedData(Collection $data, ?int $perPage = 10): PaginationLengthAwarePaginator
{
    $perPage = request('per_page', $perPage);
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $pagedData = $data->values()->slice(($currentPage - 1) * $perPage, $perPage)->all();
    $pagedData = collect($pagedData)->values();

    return new LengthAwarePaginator($pagedData, count($data), $perPage);
}

function paginateData(Collection $data, int $perPage, int $total, int $currentPage): LengthAwarePaginator
{
    $pagedData = $data->values();

    return new LengthAwarePaginator(
        $pagedData,
        $total,
        $perPage,
        $currentPage,
        ['path' => LengthAwarePaginator::resolveCurrentPath()]
    );
}

function apiSuccessGetResponse(Collection|LengthAwarePaginator $data, ?bool $isPaginated = false, ?string $message, ?bool $isAddRowNumber = true,  ?array $opt = [])
{

    if ($isAddRowNumber) {
        if (request('per_page') != null && request('per_page') != -1) {
            $data = $isPaginated ? addNumberEachRowOnPagination($data) : addNumberEachRowOnGet($data);
        } else {
            $data = $isPaginated ? addNumberEachRowOnPagination($data) : addNumberEachRowOnGet($data);
        }

        // $data = $isPaginated ? addNumberEachRowOnPagination($data) : addNumberEachRowOnGet($data);
    }

    if (!$isPaginated) {
        $nextPage = request('page', 1) >= count($data) ? null : request('page', 1) + 1;
        $data = [
            'data' => $data,
            'status' => $opt['status'] ?? Response::HTTP_OK,
            'message' => $message ?? 'Success retrieve data',
            'meta' => [
                'current_page' => request('page', 1),
                'next_page_url' => $nextPage,
                'from' => 1,
                'last_page' => 1,
                'path' => url()->current(),
                'per_page' => count($data),
                'to' => count($data),
                'total' => count($data),
            ],
        ];
    } else {

        if ($data instanceof Collection) {
            $data = getPaginatedData($data);
        }

        $nextPage = request('page', 1) == $data->lastPage() ? null : request('page', 1) + 1;

        $data = [
            'data' => $data->items(),
            'status' => $opt['status'] ?? Response::HTTP_OK,
            'message' => $message ?? 'Success retrieve data',
            'meta' => [
                'current_page' => $data->currentPage(),
                'next_page_url' => $data->nextPageUrl(),
                'from' => $data->firstItem() ?? 0,
                'last_page' => $data->lastPage(),
                'path' => $data->url(1),
                'per_page' => $data->perPage(),
                'to' => $data->lastItem() ?? 0,
                'total' => $data->total(),
            ],
        ];
    }

    if (isset($opt['additional_response'])) {
        $data = array_merge($data, $opt['additional_response']);
    }

    return response()->json($data, $opt['status'] ?? Response::HTTP_OK);
}

function apiErrorGetResponse(\Exception|ValidationException $e, ?string $message = 'Failed retrieve data', ?array $opt = [])
{
    DB::rollBack();
    Log::error($e->getMessage() ?? 'Failed retrieve data');

    $errors = [];
    if ($e instanceof ValidationException) {
        $errors = $e->errors();
        $opt['status'] = Response::HTTP_UNPROCESSABLE_ENTITY;
    }

    return response()->json([
        'data' => [],
        'status' => isset($opt['status']) ? $opt['status'] : Response::HTTP_INTERNAL_SERVER_ERROR,
        'message' => $e->getMessage() ?? $message,
        'errors' => $errors,
        'meta' => [
            'current_page' => 1,
            'next_page_url' => null,
            'from' => 1,
            'last_page' => 1,
            'path' => url()->current(),
            'per_page' => 0,
            'to' => 0,
            'total' => 0,
        ],
    ], isset($opt['status']) ? $opt['status'] : Response::HTTP_INTERNAL_SERVER_ERROR);
}

function calcTake(int $take = 150, int $perpageCount = 10): int
{
    // check if pagination in the last page
    $currentPage = request('page', 1);
    $perPage = request('per_page', $perpageCount);

    $to = $currentPage * $perPage;

    if ($to >= $take) {
        $take = (($currentPage - 1) * $perPage) + ($take % $perPage);
    }

    return $take;
}

function formatWidget(
    Collection $collection,
    array $statuses = [],
    Collection $currencies,
    string $sumKey = 'grand_total',
    string $currencyKey = 'currency_id',
    string $statusKey = 'status',
    array $includeStatuses = []
): array {
    $result = [];
    foreach ($currencies as $key => $value) {
        foreach ($statuses as $status) {
            if ($status === 'Total') {
                $result[$status][$key] = (array) $value;
                $result[$status][$key]['transactions'] = $collection->where($currencyKey, $value->id)->count();
                $result[$status][$key]['amount'] = $collection->where($currencyKey, $value->id)->sum($sumKey);
            } elseif (!!$status) {
                $result[$status][$key] = (array) $value;
                $result[$status][$key]['transactions'] = $collection->where($currencyKey, $value->id)->where($statusKey, $status)->count();
                $result[$status][$key]['amount'] = $collection->where($currencyKey, $value->id)->where($statusKey, $status)->sum($sumKey);
            }
        }
    }

    return $result;
}

function convertKeysToArray($input)
{
    if (is_array($input)) {
        $result = [];
        foreach ($input as $key => $value) {
            $result[$key] = convertKeysToArray($value);
        }
        return $result;
    } elseif (is_object($input)) {
        $array = (array) $input;
        $result = [];
        foreach ($array as $key => $value) {
            $result[$key] = convertKeysToArray($value);
        }
        return $result;
    }
    return $input;
}
