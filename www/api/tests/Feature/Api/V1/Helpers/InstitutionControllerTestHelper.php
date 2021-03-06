<?php

namespace Tests\Feature\Api\V1\Helpers;

use App\Models\Institution;
use App\Models\Location;
use App\Models\User;
use App\Services\Tests\DadataClient;
use Tests\Feature\BaseHelpers\BaseHelper;
use Tests\Feature\BaseHelpers\UserHelper;

trait InstitutionControllerTestHelper
{
    use BaseHelper, UserHelper;

    protected function getDataStore(): array {
        $institution = Institution::factory()
            ->make();
        $location = Location::factory()
            ->withFiasId()
            ->typeHouse()
            ->create();

        return [
            'name' => $institution->name,
            'fias_id' => $location->fias_id,
            'kladr_id' => $location->kladr_id,
        ];
    }

    protected function getDataStoreWithFindByDadata(): array {
        $institution = Institution::factory()
            ->make();
        $locations = DadataClient::setFindByIdAnswer(null, 1);

        return [
            'name' => $institution->name,
            'fias_id' => $locations[0]['data']['house_fias_id'],
            'kladr_id' => $locations[0]['data']['house_kladr_id'],
        ];
    }

    protected function storeJsonStructure(): array {
        return [
            'id',
            'name',
            'address',
        ];
    }

    protected function indexJsonStructure(): array {
        $structure = [
            'items' => [
                '*' => [
                    'id',
                    'name',
                    'address',
                ],
            ],
        ];
        $structure = array_merge($structure, $this->getIndexMetaStructure());

        return $structure;
    }

    protected function getDataStoreLocationNotHouseException(): array {
        $institution = Institution::factory()
            ->make();
        $location = Location::factory()
            ->withFiasId()
            ->typeStreet()
            ->create();

        return [
            'name' => $institution->name,
            'fias_id' => $location->fias_id,
            'kladr_id' => $location->kladr_id,
        ];
    }

    protected function getDataStoreInstitutionAlreadyExistsException(): array {
        $institution = Institution::factory()
            ->withLocation()
            ->create();
        $location = $institution->location()
            ->first();

        return [
            'name' => $institution->name,
            'fias_id' => $location->fias_id,
            'kladr_id' => $location->kladr_id,
        ];
    }

    protected function getDataStoreLocationNotFoundInDadataException(): array {
        $institution = Institution::factory()
            ->make();
        $location = Location::factory()
            ->withFiasId()
            ->typeHouse()
            ->make();

        return [
            'name' => $institution->name,
            'fias_id' => $location->fias_id,
            'kladr_id' => $location->kladr_id,
        ];
    }

    protected function indexGenerator(): void {
        Institution::factory()
            ->withLocation()
            ->count(rand(5,20))
            ->create();
    }

    protected function indexForUserGenerator(User $user): void {
        $this->indexGenerator();
        Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                [
                    'is_admin' => true,
                    'is_invite_accept' => true,
                ]
            )
            ->count(rand(5,20))
            ->create();
    }
}
