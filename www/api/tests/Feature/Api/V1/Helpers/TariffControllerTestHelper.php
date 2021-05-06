<?php

namespace Tests\Feature\Api\V1\Helpers;

use App\Models\Institution;
use App\Models\Service;
use App\Models\Tariff;
use App\Models\TariffTimer;
use App\Models\User;
use Tests\Feature\BaseHelpers\BaseHelper;
use Tests\Feature\BaseHelpers\UserHelper;

trait TariffControllerTestHelper
{
    use BaseHelper, UserHelper;

    protected function allJsonStructure(): array
    {
        return [
            '*' => $this->baseJsonStructure(),
        ];
    }

    protected function baseJsonStructure(): array
    {
        return [
            'id',
            'name',
            'cost_visit',
            'cost_minimum',
            'cost_per_minute',
        ];
    }

    protected function allGenerator(User $user): Institution
    {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(),
            )
            ->has(
                Tariff::factory()
                    ->withCostMinimum()
                    ->withCostVisit()
                    ->withCostPerMinute()
                    ->count(rand(5, 10))
            )
            ->create();

        return $institution;
    }

    protected function allWhenNotAcceptedInviteGenerator(User $user): Institution
    {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getFullAccessWithExcludes(['is_invite_accept'])
            )
            ->has(
                Tariff::factory()
                    ->withCostMinimum()
                    ->withCostVisit()
                    ->withCostPerMinute()
                    ->count(rand(5, 10))
            )
            ->create();

        return $institution;
    }

    protected function allWhenNotInstitutionUser(): Institution
    {
        $institution = Institution::factory()
            ->withLocation()
            ->has(
                Tariff::factory()
                    ->withCostMinimum()
                    ->withCostVisit()
                    ->withCostPerMinute()
                    ->count(rand(5, 10))
            )
            ->create();

        return $institution;
    }

    protected function getDataStore(User $user): array
    {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_can_create_tariff']),
            )
            ->create();

        $tariff = Tariff::factory()
            ->withCostVisit()
            ->withCostMinimum()
            ->withCostPerMinute()
            ->make();

        $timerArray = [];
        $numberOfTimers = rand(2, 5);
        $minuteFrom = 0;
        for ($i = 0; $i < $numberOfTimers; $i++) {
            $minuteTo = rand(5, 10) + $minuteFrom;

            $timer = TariffTimer::factory()
                ->make([
                    'minute_from' => $minuteFrom,
                    'minute_to' => $minuteTo,
                ]);

            $timerArray[] = $timer->toArray();
            $minuteFrom = $minuteTo + 1;
        }

        return [
            'institution_id' => $institution->id,
            'name' => $tariff->name,
            'cost_visit' => $tariff->cost_visit,
            'cost_minimum' => $tariff->cost_minimum,
            'cost_per_minute' => $tariff->cost_per_minute,
            'timers' => $timerArray,
        ];
    }

    protected function getDataStoreWhenIntervalIntersect(User $user): array
    {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_can_create_tariff']),
            )
            ->create();

        $tariff = Tariff::factory()
            ->withCostVisit()
            ->withCostMinimum()
            ->withCostPerMinute()
            ->make();

        $timerArray = [];
        $numberOfTimers = 3;
        $minuteFrom = 0;
        for ($i = 0; $i < $numberOfTimers; $i++) {
            $minuteTo = rand(5, 10) + $minuteFrom;

            $timer = TariffTimer::factory()
                ->make([
                    'minute_from' => $minuteFrom,
                    'minute_to' => $minuteTo,
                ]);

            $timerArray[] = $timer->toArray();
            $minuteFrom = $minuteTo;
        }

        return [
            'institution_id' => $institution->id,
            'name' => $tariff->name,
            'cost_visit' => $tariff->cost_visit,
            'cost_minimum' => $tariff->cost_minimum,
            'cost_per_minute' => $tariff->cost_per_minute,
            'timers' => $timerArray,
        ];
    }

    protected function getDataStoreWhenNameAlreadyExists(User $user): array
    {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_can_create_tariff']),
            )
            ->create();

        $tariff = Tariff::factory()
            ->withCostVisit()
            ->withCostMinimum()
            ->withCostPerMinute()
            ->create(['institution_id' => $institution->id]);
        $tariffNew = Tariff::factory()
            ->withCostVisit()
            ->withCostMinimum()
            ->withCostPerMinute()
            ->make();

        return [
            'institution_id' => $institution->id,
            'name' => $tariff->name,
            'cost_visit' => $tariffNew->cost_visit,
            'cost_minimum' => $tariffNew->cost_minimum,
            'cost_per_minute' => $tariffNew->cost_per_minute,
        ];
    }

    protected function getDataStoreAdmin(User $user): array
    {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_admin']),
            )
            ->create();

        $tariff = Tariff::factory()
            ->withCostVisit()
            ->withCostMinimum()
            ->withCostPerMinute()
            ->make();

        return [
            'institution_id' => $institution->id,
            'name' => $tariff->name,
            'cost_visit' => $tariff->cost_visit,
            'cost_minimum' => $tariff->cost_minimum,
            'cost_per_minute' => $tariff->cost_per_minute,
            'timers' => [],
        ];
    }

    protected function getDataStoreNotAccess(User $user): array
    {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getFullAccessWithExcludes(['is_can_create_tariff'])
            )
            ->create();

        $tariff = Tariff::factory()
            ->withCostVisit()
            ->withCostMinimum()
            ->withCostPerMinute()
            ->make();

        return [
            'institution_id' => $institution->id,
            'name' => $tariff->name,
            'cost_visit' => $tariff->cost_visit,
            'cost_minimum' => $tariff->cost_minimum,
            'cost_per_minute' => $tariff->cost_per_minute,
            'timers' => [],
        ];
    }

    protected function getDataStoreNotInstitutionUser(): array
    {
        $institution = Institution::factory()
            ->withLocation()
            ->create();

        $tariff = Tariff::factory()
            ->withCostVisit()
            ->withCostMinimum()
            ->withCostPerMinute()
            ->make();


        return [
            'institution_id' => $institution->id,
            'name' => $tariff->name,
            'cost_visit' => $tariff->cost_visit,
            'cost_minimum' => $tariff->cost_minimum,
            'cost_per_minute' => $tariff->cost_per_minute,
            'timers' => [],
        ];
    }

    protected function getDataUpdate(User $user): array
    {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_can_update_tariff']),
            )
            ->has(Tariff::factory()
                ->withCostVisit()
                ->withCostMinimum()
                ->withCostPerMinute()
            )
            ->create();

        $tariff = $institution->tariffs()
            ->first();

        $newTariff = Tariff::factory()
            ->withCostVisit()
            ->withCostMinimum()
            ->withCostPerMinute()
            ->make();

        $timerArray = [];
        $numberOfTimers = rand(2, 5);
        $minuteFrom = 0;
        for ($i = 0; $i < $numberOfTimers; $i++) {
            $minuteTo = rand(5, 10) + $minuteFrom;

            $timer = TariffTimer::factory()
                ->make([
                    'minute_from' => $minuteFrom,
                    'minute_to' => $minuteTo,
                ]);

            $timerArray[] = $timer->toArray();
            $minuteFrom = $minuteTo + 1;
        }

        return [
            'id' => $tariff->id,
            'name' => $tariff->name,
            'cost_visit' => $newTariff->cost_visit,
            'cost_minimum' => $newTariff->cost_minimum,
            'cost_per_minute' => $newTariff->cost_per_minute,
            'timers' => $timerArray,
        ];
    }

    protected function getDataUpdateWithoutChange(User $user): array
    {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_can_update_tariff']),
            )
            ->has(Tariff::factory()
                ->withCostVisit()
                ->withCostMinimum()
                ->withCostPerMinute()
            )
            ->create();

        $tariff = $institution->tariffs()
            ->first();

        return [
            'id' => $tariff->id,
            'name' => $tariff->name,
        ];
    }

    protected function getDataUpdateAdmin(User $user): array
    {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_admin']),
            )
            ->has(Tariff::factory()
                ->withCostVisit()
                ->withCostMinimum()
                ->withCostPerMinute()
            )
            ->create();

        $tariff = $institution->tariffs()
            ->first();

        $newTariff = Tariff::factory()
            ->withCostVisit()
            ->withCostMinimum()
            ->withCostPerMinute()
            ->make();

        return [
            'id' => $tariff->id,
            'name' => $tariff->name,
            'cost_visit' => $newTariff->cost_visit,
            'cost_minimum' => $newTariff->cost_minimum,
            'cost_per_minute' => $newTariff->cost_per_minute,
        ];
    }

    protected function getDataUpdateWithSameName(User $user): array
    {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_can_update_tariff']),
            )
            ->has(Tariff::factory()
                ->withCostVisit()
                ->withCostMinimum()
                ->withCostPerMinute()
                ->count(2)
            )
            ->create();

        $tariffFirst = $institution->tariffs[0];
        $tariffSecond = $institution->tariffs[1];

        return [
            'id' => $tariffFirst->id,
            'name' => $tariffSecond->name,
        ];
    }

    protected function getDataUpdateNotAccess(User $user): array
    {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getFullAccessWithExcludes(['is_can_update_tariff'])
            )
            ->has(Tariff::factory()
                ->withCostVisit()
                ->withCostMinimum()
                ->withCostPerMinute()
                ->count(2)
            )
            ->create();

        $tariff = $institution->tariffs()
            ->first();

        return [
            'id' => $tariff->id,
            'name' => $tariff->name,
        ];
    }

    protected function getDataUpdateNotInstitutionUser(): array
    {
        $institution = Institution::factory()
            ->withLocation()
            ->has(Tariff::factory()
                ->withCostVisit()
                ->withCostMinimum()
                ->withCostPerMinute()
            )
            ->create();

        $tariff = $institution->tariffs()
            ->first();

        return [
            'id' => $tariff->id,
            'name' => $tariff->name,
        ];
    }


    protected function getDataDelete(User $user): array
    {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_can_delete_tariff']),
            )
            ->has(Tariff::factory()
                ->withCostVisit()
                ->withCostMinimum()
                ->withCostPerMinute()
            )
            ->create();

        $tariff = $institution->tariffs()
            ->first();

        return [
            'id' => $tariff->id,
        ];
    }

    protected function getDataDeleteAdmin(User $user): array
    {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getAccessByArray(['is_admin']),
            )
            ->has(Tariff::factory()
                ->withCostVisit()
                ->withCostMinimum()
                ->withCostPerMinute()
            )
            ->create();

        $tariff = $institution->tariffs()
            ->first();

        return [
            'id' => $tariff->id,
        ];
    }

    protected function getDataDeleteNotAccess(User $user): array
    {
        $institution = Institution::factory()
            ->withLocation()
            ->hasAttached(
                $user,
                $this->getFullAccessWithExcludes(['is_can_delete_tariff'])
            )
            ->has(Tariff::factory()
                ->withCostVisit()
                ->withCostMinimum()
                ->withCostPerMinute()
            )
            ->create();

        $tariff = $institution->tariffs()
            ->first();

        return [
            'id' => $tariff->id,
        ];
    }

    protected function getDataDeleteNotInstitutionUser(): array
    {
        $institution = Institution::factory()
            ->withLocation()
            ->has(Tariff::factory()
                ->withCostVisit()
                ->withCostMinimum()
                ->withCostPerMinute()
            )
            ->create();

        $tariff = $institution->tariffs()
            ->first();

        return [
            'id' => $tariff->id,
        ];
    }
}
