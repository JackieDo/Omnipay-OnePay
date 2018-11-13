<?php namespace Omnipay\OnePay\Message;

/**
 * The InternationalFetchCheckoutRequest class
 */
class InternationalFetchCheckoutRequest extends DomesticFetchCheckoutRequest
{
    /**
     * Endpoint URL in production
     *
     * @var string
     */
    protected $liveEndpoint = 'https://onepay.vn/vpcpay/Vpcdps.op';

    /**
     * Endpoint URL in test mode
     *
     * @var string
     */
    protected $testEndpoint = 'https://mtf.onepay.vn/vpcpay/Vpcdps.op';

    /**
     * Send the request with specified data
     *
     * @param  array  $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $httpResponse = $this->httpClient->request('POST', $this->getEndpoint(), [
            'Content-Type'  => 'application/x-www-form-urlencoded',
            'cache-control' => 'no-cache'
        ], http_build_query($data, '', '&'));

        return $this->response = new InternationalFetchCheckoutResponse($this, $httpResponse->getBody()->getContents());
    }
}
