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
            '*' => $this->baseJsonStructure(),
        ];
    }

    protected function baseJsonStructure(): array {
        return [
            'id',
            'name',
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

    protected function getDataStore(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                [
                    'is_invite_accept' => true,
                    'is_can_create_place' => true,
                ]
            )
            ->create();

        $place = Place::factory()
            ->make();

        return [
            'institution_id' => $institution->id,
            'name' => $place->name,
        ];
    }

    protected function getDataStoreWhenNameAlreadyExists(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                [
                    'is_invite_accept' => true,
                    'is_can_create_place' => true,
                ]
            )
            ->create();

        $place = Place::factory()
            ->create(['institution_id' => $institution->id]);

        return [
            'institution_id' => $institution->id,
            'name' => $place->name,
            'place_id' => $place->id,
        ];
    }

    protected function getDataStoreAdmin(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                [
                    'is_invite_accept' => true,
                    'is_admin' => true,
                ]
            )
            ->create();

        $place = Place::factory()
            ->make();

        return [
            'institution_id' => $institution->id,
            'name' => $place->name,
        ];
    }

    protected function getDataStoreNotAccess(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                [
                    'is_invite_accept' => true,
                ]
            )
            ->create();

        $place = Place::factory()
            ->make();

        return [
            'institution_id' => $institution->id,
            'name' => $place->name,
        ];
    }

    protected function getDataStoreNotInstitutionUser(): array {
        $institution = Institution::factory()
            ->withLocation()
            ->create();

        $place = Place::factory()
            ->make();

        return [
            'institution_id' => $institution->id,
            'name' => $place->name,
        ];
    }
}
