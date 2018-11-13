<?php namespace Omnipay\OnePay\Message;

/**
 * The InternationalCompletePurchaseRequest class
 */
class InternationalCompletePurchaseRequest extends DomesticCompletePurchaseRequest
{
    /**
     * Send the request with specified data
     *
     * @param  array  $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new InternationalCompletePurchaseResponse($this, $data);
    }
}
