<?php

namespace Tests\Feature\Api\V1\Helpers;

use App\Models\Institution;
use App\Models\Place;
use App\Models\User;
use Tests\Feature\BaseHelpers\BaseHelper;
use Tests\Feature\BaseHelpers\UserHelper;

trait PlaceControllerTestHelper
{
    use BaseHelper, UserHelper;

    protected function allJsonStructure(): array {
        return [
            '*' => [
                'id',
                'name',
            ],
        ];
    }

    protected function allGenerator(User $user): Institution {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                [
                    'is_invite_accept' => true,
                ]
            )
            ->has(Place::factory()->count(rand(5,10)))
            ->create();

        return $institution;
    }

    protected function allWhenNotAcceptedInviteGenerator(User $user): Institution {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                [
                    'is_invite_accept' => false,
                ]
            )
            ->has(Place::factory()->count(rand(5,10)))
            ->create();

        return $institution;
    }

    protected function allWhenNotInstitutionUser(): Institution {
        $institution = Institution::factory()
            ->withLocation()
            ->has(Place::factory()->count(rand(5,10)))
            ->create();

        return $institution;
    }
}
