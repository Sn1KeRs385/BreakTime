<?php

namespace App\Helpers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class JSON
{
    static public function getJson($data = [], $error = NULL)
    {
        $object = [
            'status' => $error === NULL,
            'data' => $data
        ];

        if ($error != null) {
            $object['errors'] = $error;
        }
        return $object;
    }


    /**
     * @param ResourceCollection || LengthAwarePaginator $paginate
     * @return array
     */
    static public function getJsonPaginate($paginate)
    {
        $object = [
            'status' => true,
            'data' => [
                'items' => $paginate->items(),
                'meta' => [
                    'current_page' => (int)$paginate->currentPage(),
                    'last_page' => (int)$paginate->lastPage(),
                    'per_page' => (int)$paginate->perPage(),
                    'total' => (int)$paginate->total(),
                ]
            ]
        ];
        return $object;
    }
}
