<?php

namespace Tests\Feature\Api\V1;

use App\Constants\AccessTypes;
use App\Exceptions\Api\Dadata\LocationNotFoundInDadataException;
use App\Exceptions\Api\InstitutionAlreadyExistsException;
use App\Exceptions\Api\LocationNotHouseTypeException;
use App\Models\Institution;
use App\Services\Tests\Api\DadataClient;
use Tests\Feature\Api\V1\Helpers\InstitutionControllerTestHelper;
use Tests\TestCase;

class InstitutionControllerTest extends TestCase
{
    use InstitutionControllerTestHelper;

    protected static string $URL = "api/v1/institutions";

    public function testStore()
    {
        $user = $this->createUser();
        $dataToSend = $this->getDataStore();

        $response = $this->actingAs($user, 'api')
            ->postJson(self::$URL, $dataToSend);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure($this->storeJsonStructure()));

        $institution = Institution::find($response->decodeResponseJson()->json('data.id'));
        $this->assertNotEquals($institution, null);

        $this->assertDatabaseHas('institution_user', [
            'institution_id' => $institution->id,
            'user_id' => $user->id,
            'is_invite_accept' => true,
            'is_admin' => true,
        ]);

        $this->assertDatabaseHas('accesses', [
            'type_id' => AccessTypes::BASE,
            'institution_id' => $institution->id,
        ]);

        $access = $institution->accesses()
            ->where('type_id', AccessTypes::BASE)
            ->first();
        $this->assertEquals((clone $access->start_at)->addDays(config('settings.demo_access_duration_days')), $access->end_at);

        $dateFormat = 'd-m-Y H:i';
        $this->assertEquals($access->start_at->format($dateFormat) === now()->format($dateFormat), true);
    }

    public function testStoreWithFindByDadata()
    {
        $user = $this->createUser();
        $dataToSend = $this->getDataStoreWithFindByDadata();

        $response = $this->actingAs($user, 'api')
            ->postJson(self::$URL, $dataToSend);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure($this->storeJsonStructure()));

        $institution = Institution::find($response->decodeResponseJson()->json('data.id'));
        $this->assertNotEquals($institution, null);

        $this->assertDatabaseHas('institution_user', [
            'institution_id' => $institution->id,
            'user_id' => $user->id,
            'is_invite_accept' => true,
            'is_admin' => true,
        ]);

        $this->assertDatabaseHas('accesses', [
            'type_id' => AccessTypes::BASE,
            'institution_id' => $institution->id,
        ]);

        $access = $institution->accesses()
            ->where('type_id', AccessTypes::BASE)
            ->first();
        $this->assertEquals((clone $access->start_at)->addDays(config('settings.demo_access_duration_days')), $access->end_at);

        $dateFormat = 'd-m-Y H:i';
        $this->assertEquals($access->start_at->format($dateFormat) === now()->format($dateFormat), true);
    }

    public function testStoreLocationNotHouseException()
    {
        $user = $this->createUser();
        $dataToSend = $this->getDataStoreLocationNotHouseException();

        $response = $this->actingAs($user, 'api')
            ->postJson(self::$URL, $dataToSend);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [LocationNotHouseTypeException::class]));
    }

    public function testStoreInstitutionAlreadyExistsException()
    {
        $user = $this->createUser();
        $dataToSend = $this->getDataStoreInstitutionAlreadyExistsException();

        $response = $this->actingAs($user, 'api')
            ->postJson(self::$URL, $dataToSend);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [InstitutionAlreadyExistsException::class]));
    }

    public function testStoreLocationNotFoundInDadataException()
    {
        $user = $this->createUser();
        $dataToSend = $this->getDataStoreLocationNotFoundInDadataException();

        $response = $this->actingAs($user, 'api')
            ->postJson(self::$URL, $dataToSend);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [LocationNotFoundInDadataException::class]));
    }
}
