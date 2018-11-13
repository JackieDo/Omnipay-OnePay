<?php namespace Omnipay\OnePay\Message;

/**
 * The DomesticFetchCheckoutResponse class
 */
class DomesticFetchCheckoutResponse extends Response
{
    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return $this->getCode() === '0' && $this->isExists();
    }

    /**
     * Is the response pending?
     *
     * @return boolean
     */
    public function isPending()
    {
        return $this->getCode() === '300' && $this->isExists();
    }

    /**
     * Is the response progressing?
     *
     * @return boolean
     */
    public function isProgressing()
    {
        return $this->getCode() === '100' && $this->isExists();
    }

    /**
     * Is exists transaction?
     *
     * @return boolean
     */
    public function isExists()
    {
        return isset($this->data['vpc_DRExists']) && $this->data['vpc_DRExists'] === 'Y';
    }

    /**
     * Is not exists transaction?
     *
     * @return boolean
     */
    public function isNotExists()
    {
        return isset($this->data['vpc_DRExists']) && $this->data['vpc_DRExists'] === 'N';
    }


    /**
     * Get message from response server
     *
     * @return string
     */
    public function getMessage()
    {
        if ($this->isNotExists()) {
            return "Transaction does not exist on payment gateway.";
        }

        if (isset($this->data['vpc_TxnResponseCode'])) {
            return $this->getResponseDescription($this->data['vpc_TxnResponseCode']);
        }

        return isset($this->data['vpc_Message']) ? $this->data['vpc_Message'] : null;
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

            case '100' :
                $result = 'The transaction is in progress or not yet completed';
                break;

            case '300' :
                $result = 'Transaction is pending.';
                break;

            default :
                $result = 'Transaction is failured.';
                break;
        }

        return $result;
    }
}
