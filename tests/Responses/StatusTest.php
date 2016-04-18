<?php
namespace Tests\KiezelPay\Client\Responses;

use KiezelPay\Client\Responses\Status;

class StatusTest extends \PHPUnit_Framework_TestCase
{
    public function test_is_licensed()
    {
        $this->assertTrue((new Status(['status' => 'licensed']))->isLicensed());
        $this->assertFalse((new Status(['status' => 'trial']))->isLicensed());
        $this->assertFalse((new Status(['status' => 'unlicensed']))->isLicensed());
        $this->assertFalse((new Status([]))->isLicensed());
    }

    public function test_is_unlicensed()
    {
        $this->assertTrue((new Status(['status' => 'unlicensed']))->isUnlicensed());
        $this->assertFalse((new Status(['status' => 'licensed']))->isUnlicensed());
        $this->assertFalse((new Status(['status' => 'trial']))->isUnlicensed());
        $this->assertFalse((new Status([]))->isUnlicensed());
    }

    public function test_is_trial()
    {
        $this->assertTrue((new Status(['status' => 'trial']))->isTrial());
        $this->assertFalse((new Status(['status' => 'licensed']))->isTrial());
        $this->assertFalse((new Status(['status' => 'unlicensed']))->isTrial());
        $this->assertFalse((new Status([]))->isTrial());
    }

    public function test_is_waiting_for_user()
    {
        $this->assertTrue((new Status(['purchaseStatus' => 'waitForUser']))->waitingForUser());
        $this->assertFalse((new Status(['purchaseStatus' => 'inProgress']))->waitingForUser());
        $this->assertFalse((new Status([]))->waitingForUser());
    }

    public function test_is_in_progress()
    {
        $this->assertTrue((new Status(['purchaseStatus' => 'inProgress']))->inProgress());
        $this->assertFalse((new Status(['purchaseStatus' => 'waitForUser']))->inProgress());
        $this->assertFalse((new Status([]))->inProgress());
    }
}
