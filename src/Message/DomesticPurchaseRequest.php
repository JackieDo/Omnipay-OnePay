<?php namespace Omnipay\OnePay\Message;

/**
 * The DomesticPurchaseRequest class
 */
class DomesticPurchaseRequest extends AbstractRequest
{
    /**
     * Collect data for sending to gateway
     *
     * @return array
     */
    public function getData()
    {
        $rules = [
            'orderInfo'  => [
                'nullable'         => true,
                'required'         => true,
                'alpha_dash_space' => true
            ],
            'merchTxnRef' => [
                'nullable'             => true,
                'required'             => true,
                'iso_latin_alpha_dash' => true
            ],
            'amount' => [
                'required' => true,
                'digits'   => true,
            ],
            'currency' => [
                'nullable' => true,
                'required' => true,
                'in'       => ['VND']
            ],
            'returnUrl' => [
                'required' => true,
                'url'      => true
            ],
            'locale' => [
                'nullable' => true,
                'required' => true,
                'in'       => ['vi', 'en']
            ],
            'againLink' => [
                'nullable' => true,
                'required' => true,
                'url'      => true
            ],
            'title' => [
                'nullable'                   => true,
                'required'                   => true,
                'iso_latin_alpha_dash_space' => true
            ]
        ];

        $this->validateWithRules($rules);

        $data = array_merge([
            'vpc_Version'     => $this::API_VERSION,
            'vpc_Command'     => 'pay',
            'vpc_OrderInfo'   => $this->getOrderInfo() ?: 'Payment request',
            'vpc_MerchTxnRef' => $this->getMerchTxnRef() ?: date('YmdHis-') . rand(),
            'vpc_Amount'      => $this->getFormatedAmount(),
            'vpc_Currency'    => $this->getCurrency() ?: 'VND',
            'vpc_ReturnURL'   => $this->getReturnUrl(),
            'vpc_Locale'      => $this->getLocale() ?: $this->httpRequest->getLocale(),
            'vpc_TicketNo'    => $this->httpRequest->getClientIp(),
            'AgainLink'       => $this->getAgainLink() ?: $this->httpRequest->server->get('HTTP_REFERER'),
            'Title'           => $this->getTitle() ?: 'VPC 3-Party',
        ], $this->getBaseData());

        $checkSum = $this->createCheckSum($data, $this->getHashCode());

        $data['vpc_SecureHash'] = $checkSum;

        return $data;
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
        return $this->response = new RedirectResponse($this, $data);
    }
}
