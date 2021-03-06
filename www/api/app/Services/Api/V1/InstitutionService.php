<?php

namespace App\Services\Api\V1;


use App\Constants\AccessTypes;
use App\Exceptions\Api\InstitutionAlreadyExistsException;
use App\Models\Institution;
use App\Models\Location;
use App\Models\User;

class InstitutionService
{
    public function store(string $name, Location $location, User $user, bool $createDemoAccess = true): Institution
    {
        $institutionExists = Institution::query()
            ->where([
                'location_id' => $location->id,
                'name' => $name
            ])
            ->exists();
        if($institutionExists){
            throw new InstitutionAlreadyExistsException();
        }

        $institution = Institution::create([
            'name' => $name,
            'location_id' => $location->id
        ]);

        $institution->institutionUsers()
            ->create([
                'user_id' => $user->id,
                'is_invite_accept' => true,
                'is_admin' => true,
            ]);

        if($createDemoAccess){
            $dateNow = now();
            $institution->accesses()
                ->create([
                    'type_id' => AccessTypes::BASE,
                    'start_at' => $dateNow,
                    'end_at' => (clone $dateNow)->addDays(config('settings.demo_access_duration_days'))
                ]);
        }

        return $institution;
    }
}
