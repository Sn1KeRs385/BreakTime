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
                $this->getAccessByArray(),
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
                $this->getFullAccessWithExcludes(['is_invite_accept'])
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
                $this->getAccessByArray(['is_can_create_place']),
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
                $this->getAccessByArray(['is_can_create_place']),
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
                $this->getAccessByArray(['is_admin']),
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
                $this->getFullAccessWithExcludes(['is_can_create_place'])
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

    protected function getDataUpdate(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_can_update_place']),
            )
            ->has(Place::factory())
            ->create();

        $place = $institution->places()
            ->first();

        $newPlace = Place::factory()
            ->make();

        return [
            'id' => $place->id,
            'name' => $newPlace->name,
        ];
    }

    protected function getDataUpdateWithoutChange(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_can_update_place']),
            )
            ->has(Place::factory())
            ->create();

        $place = $institution->places()
            ->first();

        return [
            'id' => $place->id,
            'name' => $place->name,
        ];
    }

    protected function getDataUpdateAdmin(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_admin']),
            )
            ->has(Place::factory())
            ->create();

        $place = $institution->places()
            ->first();

        $newPlace = Place::factory()
            ->make();

        return [
            'id' => $place->id,
            'name' => $newPlace->name,
        ];
    }

    protected function getDataUpdateWithSameName(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_can_update_place']),
            )
            ->has(Place::factory()->count(2))
            ->create();

        $placeFirst = $institution->places[0];
        $placeSecond = $institution->places[1];

        return [
            'id' => $placeFirst->id,
            'name' => $placeSecond->name,
        ];
    }

    protected function getDataUpdateNotAccess(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getFullAccessWithExcludes(['is_can_update_place'])
            )
            ->has(Place::factory())
            ->create();

        $place = $institution->places()
            ->first();

        return [
            'id' => $place->id,
            'name' => $place->name,
        ];
    }

    protected function getDataUpdateNotInstitutionUser(): array {
        $institution = Institution::factory()
            ->withLocation()
            ->has(Place::factory())
            ->create();

        $place = $institution->places()
            ->first();

        return [
            'id' => $place->id,
            'name' => $place->name,
        ];
    }
}
