<?php namespace Omnipay\OnePay;

/**
 * The InternationalGateway class
 *
 * @link https://mtf.onepay.vn/developer/resource/documents/docx/introduction_merchant_integration.pdf
 * @link https://mtf.onepay.vn/developer/resource/documents/docx/quy_trinh_tich_hop-quocte.pdf
 */
class InternationalGateway extends DomesticGateway
{
    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     *
     * @return string
     */
    public function getName()
    {
        return 'OnePay International';
    }

    /**
     * Create a payment request for an invoice.
     *
     * @param  array $parameters
     *
     * @return \Omnipay\OnePay\Message\InternationalPurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\OnePay\Message\InternationalPurchaseRequest', $parameters);
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
     * @return \Omnipay\OnePay\Message\InternationalCompletePurchaseRequest
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\OnePay\Message\InternationalCompletePurchaseRequest', $parameters);
    }

    /**
     * Create a request to check the status of the purchase transaction,
     * based on the transaction code from the merchant website.
     *
     *
     * @param  array $parameters
     *
     * @return \Omnipay\OnePay\Message\InternationalFetchCheckoutRequest
     */
    public function fetchCheckout(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\OnePay\Message\InternationalFetchCheckoutRequest', $parameters);
    }
}
