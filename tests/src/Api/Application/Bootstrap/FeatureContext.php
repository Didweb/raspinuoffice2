<?php

namespace RaspinuOffice\Tests\Api\Application\Bootstrap;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpClient\HttpClient;


/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private int $statusCode = 0;
    private $client;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->client = HttpClient::create();
    }

    /**
     * @Given /^the Request body is:$/
     */
    public function theRequestBodyIs(string $body)
    {
        $this->body = $body;
    }

    /**
     * @When /^i PUT to "([^"]*)"$/
     */
    public function iPutTo($uri)
    {
        try {
            $response = $this->client->request(
                'PUT',
                $uri
            );
            $this->statusCode = $response->getStatusCode();
            echo "ResponseCodeIs: " . $this->statusCode ;
            return true;
        } catch (TransportException $exception) {
            throw new \Exception($exception->getMessage(),'503');
        }
    }

    /**
     * @When /^i GET to "([^"]*)"$/
     */
    public function iGetTo($uri)
    {
        try {
            $response = $this->client->request(
                'GET',
                $uri
            );
            $this->statusCode = $response->getStatusCode();
            echo "ResponseCodeIs: " . $this->statusCode ;
            return true;
        } catch (TransportException $exception) {
            throw new \Exception($exception->getMessage(),'503');
        }
    }

    /**
     * @Then /^the response code is (\d+)$/
     */
    public function theResponseCodeIs($code)
    {
        echo "ResponseCodeIs: " . $this->statusCode . " expected " . $code;
        try{
            return  $this->statusCode == $code;
        } catch (TransportException $exception) {
            throw new \Exception($exception->getMessage(),'500');
        }


    }
}
