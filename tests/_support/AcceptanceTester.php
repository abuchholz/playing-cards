<?php

use App\Card;
use Codeception\Util\Locator;
use PHPUnit_Framework_Assert as PHPUnit;

use Behat\Behat\Context\Context;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor implements Context
{
    use _generated\AcceptanceTesterActions;


    /**
     * @When I am on :arg1
     */
    public function iAmOn($arg1)
    {
        $this->amOnPage($arg1);
    }

    /**
     * @Then I should see :arg1
     */
    public function iShouldSee($arg1)
    {
        $this->see($arg1);
    }

    /**
     * @When I click the :arg1 element
     */
    public function iClickTheElement($arg1)
    {
        $this->click($arg1);
    }

    /**
     * @When I click :arg1
     */
    public function iClick($arg1)
    {
        $this->click($arg1);
    }

    /**
     * @When I wait for :numberOfSeconds seconds
     */
    public function iWaitForSeconds($numberOfSeconds)
    {
        $this->wait($numberOfSeconds);
    }

    /**
     * @Given I am on the homepage
     */
    public function iAmOnTheHomepage()
    {
        $this->amOnPage('/');
    }

    /**
     * @Given I follow :arg1
     */
    public function iFollow($arg1)
    {
        $this->click($arg1);
    }

    /**
     * @When I press :arg1
     */
    public function iPress($arg1)
    {
        $this->click('//button[text()="' . $arg1 . '"]');
    }

    /**
     * @Then I should not see :arg1
     */
    public function iShouldNotSee($arg1)
    {
        $this->dontSee($arg1);
    }

    /**
     * @When I should be on :arg1
     */
    public function iShouldBeOn($arg1)
    {
        $this->seeCurrentUrlEquals($arg1);
    }

    /**
     * @Then I should be on the homepage
     */
    public function iShouldBeOnTheHomepage()
    {
        $this->seeCurrentUrlEquals('/');
    }

}
