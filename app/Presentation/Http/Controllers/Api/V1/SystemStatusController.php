<?php

namespace App\Presentation\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\UseCases\System\GetSystemStatus;
use Illuminate\Http\JsonResponse;

class SystemStatusController extends Controller
{
    public function __invoke(GetSystemStatus $getSystemStatus): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $getSystemStatus->handle(),
        ]);
    }
}
