<?php
namespace App\Traits;

/**
 *
 */
trait ApiResponser
{
    protected function successdouble($data, $datatwo, string $message = null, int $code = 200) {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data,
            'datatwo' => $datatwo,
        ], $code);
    }

    protected function success($data, string $message = null, int $code = 200) {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function error(string $message = null, $data = null, int $code = 200) {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'errors' => $data,
        ], $code);
    }
}
