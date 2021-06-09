<?php
namespace  RaspinuOffice\Tests\Api\Application\Bootstrap;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpClient\HttpClient;


/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private int $statusCode;
    private  $client;
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
     * @When /^i GET to "([^"]*)"$/
     */
    public function iPostTo($uri)
    {
        try {
            $response = $this->client->request(
                'GET',
                'http://localhost:8080/api/check/status'
            );
            $this->statusCode = $response->getStatusCode();
        } catch (TransportException $exception) {
            $this->statusCode = 503;
        }
        return true;
    }

    /**
     * @Then /^the response code is (\d+)$/
     */
    public function theResponseCodeIs($code)
    {
        return $this->statusCode === $code;
    }
}
