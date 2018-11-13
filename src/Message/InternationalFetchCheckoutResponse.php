<?php namespace Omnipay\OnePay\Message;

/**
 * The InternationalFetchCheckoutResponse class
 */
class InternationalFetchCheckoutResponse extends DomesticFetchCheckoutResponse
{
    /**
     * Is the response pending?
     *
     * @return boolean
     */
    public function isPending()
    {
        return false;
    }

    /**
     * Is the response progressing?
     *
     * @return boolean
     */
    public function isProgressing()
    {
        return false;
    }

    /**
     * Get description of response code from server
     *
     * @param  string $responseCode
     *
     * @return string
     */
    public function getResponseDescription($responseCode)
    {
        switch ($responseCode) {
            case '0' :
                $result = 'Transaction is approved.';
                break;

            default :
                $result = 'Transaction is failured.';
                break;
        }

        return $result;
    }
}
