<?php namespace Omnipay\OnePay\Traits;

/**
 * HasCheckSumTrait
 *
 * @package omnipay-onepay
 * @author Jackie Do <anhvudo@gmail.com>
 * @copyright 2018
 * @version $Id$
 * @access public
 */
trait HasCheckSumTrait
{
    /**
     * Store checksum string
     *
     * @var string
     */
    protected $checkSum;

    /**
     * Get chechsum string
     *
     * @return string
     */
    protected function getCheckSum()
    {
        return $this->checkSum;
    }

    /**
     * Store checksum string
     *
     * @param  array        $data
     * @param  null|string  $secure_secret
     *
     * @return $this
     */
    protected function setCheckSum(array $data = [], $secure_secret = null)
    {
        $this->checkSum = $this->createCheckSum($data, $secure_secret);

        return $this;
    }

    /**
     * Generate a computed hash string for checksum
     *
     * @param  array        $data
     * @param  null|string  $secure_secret
     *
     * @return null|string
     */
    protected function createCheckSum(array $data = [], $secure_secret = null)
    {
        if (isset($secure_secret)) {
            // Remove element with key vpc_SecureHash and vpc_SecureHashType out of from $data if exists
            unset($data['vpc_SecureHash']);

            // Arrange array data a-z before make a hash
            ksort($data);

            // Generate empty string
            $stringHashData = '';

            // Get all the none-empty element in $data and append it to hash string
            foreach ($data as $key => $value) {
                if ((strlen($value) > 0) && (substr($key, 0, 4) == 'vpc_') || (substr($key, 0, 5) == 'user_')) {
                    $stringHashData .= $key . '=' . $value . '&';
                }
            }

            // Remove the last `&` character
            $stringHashData = rtrim($stringHashData, '&');

            return strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*', $secure_secret)));
        }

        return null;
    }
}
