<?php

namespace Tests\Feature\Api\V1;

use App\Models\Service;
use App\Models\Tariff;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Arr;
use Tests\Feature\Api\V1\Helpers\TariffControllerTestHelper;
use Tests\TestCase;

class TariffControllerTest extends TestCase
{
    use TariffControllerTestHelper;

    protected static string $URL = "api/v1/tariffs";

    public function testAll()
    {
        $user = $this->createUser();
        $institution = $this->allGenerator($user);

        $response = $this->actingAs($user, 'api')
            ->json('GET', self::$URL, ['institution_id' => $institution->id]);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure($this->allJsonStructure()));

        $response->assertJsonCount($institution->tariffs()->count(), 'data');
    }

    public function testAllWhenNotAcceptedInvite()
    {
        $user = $this->createUser();
        $institution = $this->allWhenNotAcceptedInviteGenerator($user);

        $response = $this->actingAs($user, 'api')
            ->json('GET', self::$URL, ['institution_id' => $institution->id]);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));
    }

    public function testAllWhenNotInstitutionUser()
    {
        $user = $this->createUser();
        $institution = $this->allWhenNotInstitutionUser();

        $response = $this->actingAs($user, 'api')
            ->json('GET', self::$URL, ['institution_id' => $institution->id]);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));
    }

    public function testStore()
    {
        $user = $this->createUser();
        $data = $this->getDataStore($user);

        $dataCheckDB = Arr::only($data, ['institution_id', 'name', 'cost_visit', 'cost_minimum', 'cost_per_minute']);
        $this->assertDatabaseMissing('tariffs', $dataCheckDB);

        $response = $this->actingAs($user, 'api')
            ->json('POST', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $this->assertDatabaseHas('tariffs', $dataCheckDB);

        $tariff = Tariff::find($response->decodeResponseJson()->json('data.id'));
        foreach($data['timers'] as $timer) {
            $this->assertDatabaseHas('tariff_timers', [
                'tariff_id' => $tariff->id,
                'minute_from' => $timer['minute_from'],
                'minute_to' => $timer['minute_to'],
                'cost' => $timer['cost'],
            ]);
        }
    }

    public function testStoreWhenIntervalsIntersect()
    {
        $user = $this->createUser();
        $data = $this->getDataStoreWhenIntervalIntersect($user);

        $dataCheckDB = Arr::only($data, ['institution_id', 'name', 'cost_visit', 'cost_minimum', 'cost_per_minute']);
        $this->assertDatabaseMissing('tariffs', $dataCheckDB);

        $response = $this->actingAs($user, 'api')
            ->json('POST', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], []));

        $error = $response->decodeResponseJson()->json('errors')[0];

        $this->assertEquals('timers', $error['field']);
        $this->assertEquals(__('custom-validation.intervals_intersect'), $error['description']);

        $this->assertDatabaseMissing('tariffs', $dataCheckDB);
    }

    public function testStoreWhenNameAlreadyExists()
    {
        $user = $this->createUser();
        $data = $this->getDataStoreWhenNameAlreadyExists($user);

        $dataCheckDB = Arr::only($data, ['institution_id', 'name', 'cost_visit', 'cost_minimum', 'cost_per_minute']);
        $this->assertDatabaseMissing('tariffs', $dataCheckDB);

        $countBeforeRequest = Tariff::count();

        $response = $this->actingAs($user, 'api')
            ->json('POST', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], []));

        $error = $response->decodeResponseJson()->json('errors')[0];

        $this->assertEquals('name', $error['field']);

        $this->assertDatabaseMissing('tariffs', $dataCheckDB);

        $countAfterRequest = Tariff::count();

        $this->assertEquals($countBeforeRequest, $countAfterRequest);
    }

    public function testStoreAdmin()
    {
        $user = $this->createUser();
        $data = $this->getDataStoreAdmin($user);

        $dataCheckDB = Arr::only($data, ['institution_id', 'name', 'cost_visit', 'cost_minimum', 'cost_per_minute']);
        $this->assertDatabaseMissing('tariffs', $dataCheckDB);

        $response = $this->actingAs($user, 'api')
            ->json('POST', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $this->assertDatabaseHas('tariffs', $dataCheckDB);

        $tariff = Tariff::find($response->decodeResponseJson()->json('data.id'));

        $this->assertDatabaseMissing('tariff_timers', [
            'tariff_id' => $tariff->id
        ]);
    }

    public function testStoreNotAccess()
    {
        $user = $this->createUser();
        $data = $this->getDataStoreNotAccess($user);

        $dataCheckDB = Arr::only($data, ['institution_id', 'name', 'cost_visit', 'cost_minimum', 'cost_per_minute']);
        $this->assertDatabaseMissing('tariffs', $dataCheckDB);

        $response = $this->actingAs($user, 'api')
            ->json('POST', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));

        $this->assertDatabaseMissing('tariffs', $dataCheckDB);
    }

    public function testStoreNotInstitutionUser()
    {
        $user = $this->createUser();
        $data = $this->getDataStoreNotInstitutionUser();

        $dataCheckDB = Arr::only($data, ['institution_id', 'name', 'cost_visit', 'cost_minimum', 'cost_per_minute']);
        $this->assertDatabaseMissing('tariffs', $dataCheckDB);

        $response = $this->actingAs($user, 'api')
            ->json('POST', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));

        $this->assertDatabaseMissing('tariffs', $dataCheckDB);
    }

    public function testUpdate()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdate($user);

        $dataCheckDB = Arr::only($data, ['institution_id', 'name', 'cost_visit', 'cost_minimum', 'cost_per_minute']);
        $this->assertDatabaseMissing('tariffs', $dataCheckDB);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $this->assertDatabaseHas('tariffs', $dataCheckDB);
        $tariff = Tariff::find($response->decodeResponseJson()->json('data.id'));

        foreach($data['timers'] as $timer) {
            $this->assertDatabaseHas('tariff_timers', [
                'tariff_id' => $tariff->id,
                'minute_from' => $timer['minute_from'],
                'minute_to' => $timer['minute_to'],
                'cost' => $timer['cost'],
            ]);
        }
    }

    public function testUpdateWithoutChange()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdateWithoutChange($user);

        $this->assertDatabaseHas('tariffs', $data);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson($data))
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $this->assertDatabaseHas('tariffs', $data);
    }

    public function testUpdateAdmin()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdateAdmin($user);

        $this->assertDatabaseMissing('tariffs', $data);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);


        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson($data))
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $this->assertDatabaseHas('tariffs', $data);
    }

    public function testUpdateWithSameName()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdateWithSameName($user);

        $this->assertDatabaseMissing('tariffs', $data);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([
                [
                    'code' => 422,
                    'field' => 'name',
                    'message' => 'VALIDATION_EXCEPTION'
                ]
            ]));

        $this->assertDatabaseMissing('tariffs', $data);
    }


    public function testUpdateNotAccess()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdateNotAccess($user);

        $this->assertDatabaseHas('tariffs', $data);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));

        $this->assertDatabaseHas('tariffs', $data);
    }

    public function testUpdateNotInstitutionUser()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdateNotInstitutionUser();

        $this->assertDatabaseHas('tariffs', $data);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));

        $this->assertDatabaseHas('tariffs', $data);
    }


    public function testDelete()
    {
        $user = $this->createUser();
        $data = $this->getDataDelete($user);

        $this->assertDatabaseHas('tariffs', $data);

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure());

        $this->assertSoftDeleted('tariffs', $data);
    }

    public function testDeleteAdmin()
    {
        $user = $this->createUser();
        $data = $this->getDataDeleteAdmin($user);

        $this->assertDatabaseHas('tariffs', $data);

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure());

        $this->assertSoftDeleted('tariffs', $data);
    }

    public function testDeleteNotAccess()
    {
        $user = $this->createUser();
        $data = $this->getDataDeleteNotAccess($user);
        $data['deleted_at'] = null;

        $this->assertDatabaseHas('tariffs', $data);

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));

        $this->assertDatabaseHas('tariffs', $data);
    }

    public function testDeleteNotInstitutionUser()
    {
        $user = $this->createUser();
        $data = $this->getDataDeleteNotInstitutionUser();
        $data['deleted_at'] = null;

        $this->assertDatabaseHas('tariffs', $data);

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));

        $this->assertDatabaseHas('tariffs', $data);
    }
}
