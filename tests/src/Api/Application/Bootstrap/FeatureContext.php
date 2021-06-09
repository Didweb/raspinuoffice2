<?php
namespace  RaspinuOffice\Tests\Api\Application\Bootstrap;

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
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
        return true;
    }

    /**
     * @Then /^the response code is (\d+)$/
     */
    public function theResponseCodeIs($code)
    {
        return $code === 200;
    }
}
