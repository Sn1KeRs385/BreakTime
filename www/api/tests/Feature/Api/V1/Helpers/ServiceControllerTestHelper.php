<?php

namespace Tests\Feature\Api\V1\Helpers;

use App\Models\Institution;
use App\Models\Service;
use App\Models\User;
use Tests\Feature\BaseHelpers\BaseHelper;
use Tests\Feature\BaseHelpers\UserHelper;

trait ServiceControllerTestHelper
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
            'price',
        ];
    }

    protected function allGenerator(User $user): Institution {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(),
            )
            ->has(Service::factory()->count(rand(5,10)))
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
            ->has(Service::factory()->count(rand(5,10)))
            ->create();

        return $institution;
    }

    protected function allWhenNotInstitutionUser(): Institution {
        $institution = Institution::factory()
            ->withLocation()
            ->has(Service::factory()->count(rand(5,10)))
            ->create();

        return $institution;
    }

    protected function getDataStore(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_can_create_service']),
            )
            ->create();

        $service = Service::factory()
            ->make();

        return [
            'institution_id' => $institution->id,
            'name' => $service->name,
            'price' => $service->price,
        ];
    }

    protected function getDataStoreWhenNameAlreadyExists(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_can_create_service']),
            )
            ->create();

        $service = Service::factory()
            ->create(['institution_id' => $institution->id]);

        return [
            'institution_id' => $institution->id,
            'name' => $service->name,
            'price' => $service->price,
            'service_id' => $service->id,
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

        $service = Service::factory()
            ->make();

        return [
            'institution_id' => $institution->id,
            'name' => $service->name,
            'price' => $service->price,
        ];
    }

    protected function getDataStoreNotAccess(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getFullAccessWithExcludes(['is_can_create_service'])
            )
            ->create();

        $service = Service::factory()
            ->make();

        return [
            'institution_id' => $institution->id,
            'name' => $service->name,
            'price' => $service->price,
        ];
    }

    protected function getDataStoreNotInstitutionUser(): array {
        $institution = Institution::factory()
            ->withLocation()
            ->create();

        $service = Service::factory()
            ->make();

        return [
            'institution_id' => $institution->id,
            'name' => $service->name,
            'price' => $service->price,
        ];
    }

    protected function getDataUpdate(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_can_update_service']),
            )
            ->has(Service::factory())
            ->create();

        $service = $institution->services()
            ->first();

        $newService = Service::factory()
            ->make();

        return [
            'id' => $service->id,
            'name' => $newService->name,
            'price' => $newService->price,
        ];
    }

    protected function getDataUpdateWithoutChange(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_can_update_service']),
            )
            ->has(Service::factory())
            ->create();

        $service = $institution->services()
            ->first();

        return [
            'id' => $service->id,
            'name' => $service->name,
            'price' => $service->price,
        ];
    }

    protected function getDataUpdateAdmin(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_admin']),
            )
            ->has(Service::factory())
            ->create();

        $service = $institution->services()
            ->first();

        $newService = Service::factory()
            ->make();

        return [
            'id' => $service->id,
            'name' => $newService->name,
            'price' => $newService->price,
        ];
    }

    protected function getDataUpdateWithSameName(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_can_update_service']),
            )
            ->has(Service::factory()->count(2))
            ->create();

        $serviceFirst = $institution->services[0];
        $serviceSecond = $institution->services[1];

        return [
            'id' => $serviceFirst->id,
            'name' => $serviceSecond->name,
            'price' => $serviceSecond->price,
        ];
    }

    protected function getDataUpdateNotAccess(User $user): array {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getFullAccessWithExcludes(['is_can_update_service'])
            )
            ->has(Service::factory())
            ->create();

        $service = $institution->services()
            ->first();

        return [
            'id' => $service->id,
            'name' => $service->name,
            'price' => $service->price,
        ];
    }

    protected function getDataUpdateNotInstitutionUser(): array {
        $institution = Institution::factory()
            ->withLocation()
            ->has(Service::factory())
            ->create();

        $service = $institution->services()
            ->first();

        return [
            'id' => $service->id,
            'name' => $service->name,
            'price' => $service->price,
        ];
    }
}
