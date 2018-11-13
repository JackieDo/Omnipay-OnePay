<?php namespace Omnipay\OnePay;

use Omnipay\Common\AbstractGateway;
use Omnipay\OnePay\Traits\ParamsAccessorMutatorTrait;

/**
 * The DomesticGateway class
 *
 * @link https://mtf.onepay.vn/developer/resource/documents/docx/introduction_merchant_integration_local.pdf
 * @link https://mtf.onepay.vn/developer/resource/documents/docx/quy_trinh_tich_hop-noidia.pdf
 */
class DomesticGateway extends AbstractGateway
{
    use ParamsAccessorMutatorTrait;

    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     *
     * @return string
     */
    public function getName()
    {
        return 'OnePay Domestic';
    }

    /**
     * Define gateway parameters, in the following format:
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'merchant'   => '',
            'accessCode' => '',
            'hashCode'   => '',
            'user'       => '',
            'password'   => '',
            'testMode'   => false,
        ];
    }

    /**
     * Create a payment request for an invoice.
     *
     * @param  array $parameters
     *
     * @return \Omnipay\OnePay\Message\DomesticPurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\OnePay\Message\DomesticPurchaseRequest', $parameters);
    }

    /**
     * Create a request to check the status of payment after purchase based
     * on the parameters returned on the browser.
     *
     * This function is usually executed on the return page provided to
     * OnePay.
     *
     * @param  array $parameters
     *
     * @return \Omnipay\OnePay\Message\DomesticCompletePurchaseRequest
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\OnePay\Message\DomesticCompletePurchaseRequest', $parameters);
    }

    /**
     * Create a request to check the status of the purchase transaction,
     * based on the transaction code from the merchant website.
     *
     *
     * @param  array $parameters
     *
     * @return \Omnipay\OnePay\Message\DomesticFetchCheckoutRequest
     */
    public function fetchCheckout(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\OnePay\Message\DomesticFetchCheckoutRequest', $parameters);
    }
}
