<?php namespace Omnipay\OnePay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * The DomesticFetchCheckoutRequest class
 */
class DomesticFetchCheckoutRequest extends AbstractRequest
{
    /**
     * API Version
     */
    const API_VERSION = '1';

    /**
     * Endpoint URL in production
     *
     * @var string
     */
    protected $liveEndpoint = 'https://onepay.vn/onecomm-pay/Vpcdps.op';

    /**
     * Endpoint URL in test mode
     *
     * @var string
     */
    protected $testEndpoint = 'https://mtf.onepay.vn/onecomm-pay/Vpcdps.op';

    /**
     * Collect data for sending to gateway
     *
     * @return array
     */
    public function getData()
    {
        if (empty($this->getMerchTxnRef())) {
            $this->setMerchTxnRef($this->httpRequest->query->get('vpc_MerchTxnRef'));
        }

        $rules = [
            'merchTxnRef' => [
                'required'             => true,
                'iso_latin_alpha_dash' => true
            ],
            'user' => [
                'required' => true,
            ],
            'password' => [
                'required' => true
            ]
        ];

        $this->validateWithRules($rules);

        $data = [
            'vpc_Version'     => $this::API_VERSION,
            'vpc_Command'     => 'queryDR',
            'vpc_MerchTxnRef' => $this->getMerchTxnRef(),
            'vpc_User'        => $this->getUser(),
            'vpc_Password'    => $this->getPassword()
        ];

        return array_merge($data, $this->getBaseData());
    }

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

        return $this->response = new DomesticFetchCheckoutResponse($this, $httpResponse->getBody()->getContents());
    }
}
