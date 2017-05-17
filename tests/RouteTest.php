<?php
/**
 * Created by PhpStorm.
 * User: 17014
 * Date: 17/05/2017
 * Time: 15:08
 */

namespace tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RouteTest extends WebTestCase
{
    /**
     * @dataProvider goodUrls
     */
    public function testSuccess($url) {

        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * @dataProvider badUrls
     */
    public function testNotSuccess($url) {

        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertFalse($client->getResponse()->isSuccessful());
    }

    public function goodUrls() {
        return array(
            array('/validation/2'),
            array('/info'),
        );
    }

    public function badUrls() {
        return array(
            array('/validation/52'),
            array('/52'),
        );
    }

}