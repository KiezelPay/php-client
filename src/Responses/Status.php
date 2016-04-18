<?php
namespace KiezelPay\Client\Responses;

class Status implements Response
{
    /**
     * @var string
     */
    protected $status;

    /**
     * @var int
     */
    protected $paymentCode;

    /**
     * @var string
     */
    protected $purchaseStatus;

    /**
     * @var string
     */
    protected $checksum;

    /**
     * @var int
     */
    protected $validityPeriodInDays;

    /**
     * @var int
     */
    protected $trialDurationInSeconds;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->status                 = isset($data['status']) ? $data['status'] : null;
        $this->paymentCode            = isset($data['paymentCode']) ? $data['paymentCode'] : null;
        $this->purchaseStatus         = isset($data['purchaseStatus']) ? $data['purchaseStatus'] : null;
        $this->checksum               = isset($data['checksum']) ? $data['checksum'] : null;
        $this->validityPeriodInDays   = isset($data['validityPeriodInDays']) ? $data['validityPeriodInDays'] : null;
        $this->trialDurationInSeconds = isset($data['trialDurationInSeconds']) ? $data['trialDurationInSeconds'] : null;
    }

    /**
     * @return bool
     */
    public function isLicensed()
    {
        return $this->getStatus() === 'licensed';
    }

    /**
     * @return bool
     */
    public function isUnlicensed()
    {
        return $this->getStatus() === 'unlicensed';
    }

    /**
     * @return bool
     */
    public function isTrial()
    {
        return $this->getStatus() === 'trial';
    }

    /**
     * @return bool
     */
    public function waitingForUser()
    {
        return $this->getPurchaseStatus() === 'waitForUser';
    }

    /**
     * @return bool
     */
    public function inProgress()
    {
        return $this->getPurchaseStatus() === 'inProgress';
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getPaymentCode()
    {
        return $this->paymentCode;
    }

    /**
     * @return string
     */
    public function getPurchaseStatus()
    {
        return $this->purchaseStatus;
    }

    /**
     * @return string
     */
    public function getChecksum()
    {
        return $this->checksum;
    }

    /**
     * @return int
     */
    public function getValidityPeriodInDays()
    {
        return $this->validityPeriodInDays;
    }

    /**
     * @return int
     */
    public function getTrialDurationInSeconds()
    {
        return $this->trialDurationInSeconds;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'status'                 => $this->status,
            'paymentCode'            => $this->paymentCode,
            'purchaseStatus'         => $this->purchaseStatus,
            'checksum'               => $this->checksum,
            'validityPeriodInDays'   => $this->validityPeriodInDays,
            'trialDurationInSeconds' => $this->trialDurationInSeconds,
        ];
    }
}
