<?php

namespace Tests\Unit;

use App\Entity;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
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

        dump('/api/entites/' . json_encode($user_options));

        $response = $this->get( '/api/entities/' . json_encode($user_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());

        dump('/api/entity/' . json_encode($entity_options));

        $response = $this->get( '/api/entity/' . json_encode($entity_options), $this->headers($user));

        dump($response->assertStatus(200)->getStatusCode());

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



    }
}
