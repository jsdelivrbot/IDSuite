<?php

namespace Tests\Unit;

use App\Endpoint;
use App\Entity;
use App\Record;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{

    /**
     * Return request headers needed to interact with the API.
     *
     * @param User|null $user
     * @return array
     */
    protected function headers(User $user = null)
    {
        $headers = ['Accept' => 'application/json'];

        if (!is_null($user)) {
            $token = $user->createToken('PHPUNIT TEST')->accessToken;
            $headers['Authorization'] = 'Bearer ' . $token;
        }

        return $headers;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200)->getStatusCode();

        $user = User::getUserByEmail('bbriggs@e-idsolutions.com');
        $entity = Entity::getByName('CUMMINS');

        $user_options = array(
            "id" => $user->id
        );

        $entity_options = array(
            'id' => $entity->id
        );

        $record = (new Record)->first();


        $record_options = array(
            "id" => $record->id
        );

        $endpoint = (new Endpoint)->first();

        $endpoint_options = array(
            "id" => $endpoint->id
        );



        /**
         * ENTITY ROUTES
         */
        dump('/api/entites/' . json_encode($user_options));

        $response = $this->get( '/api/entities/' . json_encode($user_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());



        dump('/api/entity/' . json_encode($entity_options));

        $response = $this->get( '/api/entity/' . json_encode($entity_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());



        dump('/api/entity/managers/' . json_encode($entity_options));

        $response = $this->get( '/api/entity/managers/' . json_encode($entity_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());

        /**
         * CHART ROUTES
         */
        dump('/api/chart/callVolumeOverTime/' . json_encode($entity_options));

        $response = $this->get( '/api/chart/callVolumeOverTime/' . json_encode($entity_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());



        dump('/api/chart/deviceByType/' . json_encode($entity_options));

        $response = $this->get( '/api/chart/deviceByType/' . json_encode($entity_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());



        dump('/api/chart/deviceUpStatusAll/' . json_encode($entity_options));

        $response = $this->get( '/api/chart/deviceUpStatusAll/' . json_encode($entity_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());



        dump('/api/chart/deviceUpStatusPercentAll/' . json_encode($entity_options));

        $response = $this->get( '/api/chart/deviceUpStatusPercentAll/' . json_encode($entity_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());



        dump('/api/chart/protocolbreakout/' . json_encode($entity_options));

        $response = $this->get( '/api/chart/protocolbreakout/' . json_encode($entity_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());



        dump('/api/chart/totalcallduration/' . json_encode($entity_options));

        $response = $this->get( '/api/chart/totalcallduration/' . json_encode($entity_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());


        dump('/api/chart/averagecallduration/' . json_encode($entity_options));

        $response = $this->get( '/api/chart/averagecallduration/' . json_encode($entity_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());


        dump('/api/chart/accountcases/' . json_encode($entity_options));

        $response = $this->get( '/api/chart/accountcases/' . json_encode($entity_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());

        dump('/api/chart/casesopened/' . json_encode($entity_options));

        $response = $this->get( '/api/chart/casesopened/' . json_encode($entity_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());


//        dump('/api/chart/devicePingData/' . json_encode($endpoint_options));
//
//        $response = $this->get( '/api/chart/devicePingData/' . json_encode($endpoint_options), $this->headers($user));
//
//        dump($response->assertStatus(200)->getStatusCode());
//
//        dump('/api/chart/deviceCostPerCallAvg/' . json_encode($endpoint_options));
//
//        $response = $this->get( '/api/chart/deviceCostPerCallAvg/' . json_encode($endpoint_options), $this->headers($user));
//
//        dump($response->assertStatus(200)->getStatusCode());


        /**
         * RECORD ROUTES
         */


        dump('/records/getRecordDetails/' . json_encode($record_options));

        $response = $this->get( '/api/records/getRecordDetails/' . json_encode($record_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());

        /**
         * ENDPOINT ROUTES
         */



        dump('/api/endpoints/' . json_encode($user_options));

        $response = $this->get( '/api/endpoints/' . json_encode($user_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());

        dump('/api/endpoint/' . json_encode($endpoint_options));

        $response = $this->get( '/api/endpoint/' . json_encode($endpoint_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());

        dump('/endpoint/getDeviceStatus/' . json_encode($endpoint_options));

        $response = $this->get( '/api/endpoint/getDeviceStatus/' . json_encode($endpoint_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());


        /**
         * NOTE ROUTES
         */
        dump('/notes/' . json_encode($entity_options));

        $response = $this->get( '/api/notes/' . json_encode($entity_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());


        /**
         * ENUM ROUTES
         */



        dump('/api/enum/measure/links/' . json_encode($entity_options));

        $response = $this->get( '/api/enum/measure/links/' . json_encode($entity_options), $this->headers($user));

        dump($response->getContent());

        dump($response->assertStatus(200)->getStatusCode());



        dump('/api/enum/modelTypeEnum/' . json_encode($entity_options));

        $response = $this->get( '/api/enum/modelTypeEnum/' . json_encode($entity_options), $this->headers($user));

        dump($response->getContent());

        dump($response->assertStatus(200)->getStatusCode());



        dump('/api/enum/classCodeEnum/' . json_encode($entity_options));

        $response = $this->get( '/api/enum/classCodeEnum/' . json_encode($entity_options), $this->headers($user));

        dump($response->getContent());

        dump($response->assertStatus(200)->getStatusCode());



        dump('/api/enum/statusEnum/' . json_encode($entity_options));

        $response = $this->get( '/api/enum/statusEnum/' . json_encode($entity_options), $this->headers($user));

        dump($response->getContent());

        dump($response->assertStatus(200)->getStatusCode());



        dump('/api/enum/titleEnum/' . json_encode($entity_options));

        $response = $this->get( '/api/enum/titleEnum/' . json_encode($entity_options), $this->headers($user));

        dump($response->getContent());

        dump($response->assertStatus(200)->getStatusCode());



        dump('/api/enum/genderEnum/' . json_encode($entity_options));

        $response = $this->get( '/api/enum/genderEnum/' . json_encode($entity_options), $this->headers($user));

        dump($response->getContent());

        dump($response->assertStatus(200)->getStatusCode());



        dump('/api/enum/phoneTypeEnum/' . json_encode($entity_options));

        $response = $this->get( '/api/enum/phoneTypeEnum/' . json_encode($entity_options), $this->headers($user));

        dump($response->getContent());

        dump($response->assertStatus(200)->getStatusCode());


        //STATS ROUTE//

        dump('/api/measure/stats/' . json_encode($user_options));

        $response = $this->get( '/api/measure/stats/' . json_encode($user_options), $this->headers($user));

        dump($response->getContent());

        dump($response->assertStatus(200)->getStatusCode());

    }
}
