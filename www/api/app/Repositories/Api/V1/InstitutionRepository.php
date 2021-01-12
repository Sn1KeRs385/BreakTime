<?php

namespace App\Repositories\Api\V1;


use App\Models\Institution;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InstitutionRepository
{
    public function index(int $perPage, bool $onlyMy, array $filters, User $user): LengthAwarePaginator
    {
        $institutions = Institution::query()
            ->when($onlyMy, function($query) use($user){
                $query->whereHas('institutionUsers', function($query) use($user){
                    $query->whereUserId($user->id);
                });
            })
            ->paginate($perPage);

        return $institutions;
    }
}
