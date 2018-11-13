<?php namespace Omnipay\OnePay\Message;

/**
 * The InternationalPurchaseRequest class
 */
class InternationalPurchaseRequest extends DomesticPurchaseRequest
{
    /**
     * Endpoint URL in production
     *
     * @var string
     */
    protected $liveEndpoint = 'https://onepay.vn/vpcpay/vpcpay.op';

    /**
     * Endpoint URL in test mode
     *
     * @var string
     */
    protected $testEndpoint = 'https://mtf.onepay.vn/vpcpay/vpcpay.op';

    /**
     * Collect data for sending to gateway
     *
     * @return array
     */
    public function getData()
    {
        $data = parent::getData();

        unset($data['vpc_Currency']);

        $checkSum = $this->createCheckSum($data, $this->getHashCode());

        $data['vpc_SecureHash'] = $checkSum;

        return $data;
    }
}
