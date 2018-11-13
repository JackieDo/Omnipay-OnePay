<?php namespace Omnipay\OnePay\Traits;

use Omnipay\Common\Exception\BadMethodCallException;

/**
 * ParamsAccessorMutatorTrait
 *
 * @package omnipay-onepay
 * @author Jackie Do <anhvudo@gmail.com>
 * @copyright 2018
 * @version $Id$
 * @access public
 */
trait ParamsAccessorMutatorTrait
{
    /**
     * Initialize this gateway with default parameters
     *
     * @param  array $parameters
     *
     * @return $this
     */
    public function initialize(array $parameters = array())
    {
        $modifiers = [];

        foreach ($parameters as $key => $value) {
            if (substr($key, 0, 4) == 'vpc_') {
                $key = substr_replace($key, '', 0, 4);
            }

            $modifiers[$key] = $value;
        }

        return parent::initialize($modifiers);
    }

    /**
     * Method overloading
     *
     * @param  string $name      The name of the method being called
     * @param  array  $arguments Enumerated array containing the parameters passed to the $name'ed method.
     * @throws BadMethodCallException
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $catchFirstSix = substr($name, 0, 6);
        $catchAtSeven  = substr($name, 6, 1);
        $replaceLength = $catchAtSeven == '_' ? 7 : 6;

        switch (true) {
            case (strtolower($catchFirstSix) == 'setvpc'):
                $alias = substr_replace($name, 'set', 0, $replaceLength);
                break;

            case (strtolower($catchFirstSix) == 'getvpc'):
                $alias = substr_replace($name, 'get', 0, $replaceLength);
                break;

            default:
                $alias = $name;
                break;
        }

        if (!method_exists($this, $alias)) {
            throw new BadMethodCallException('Call to undefined method ' .get_class($this). '::' . $alias . '()');
        }

        return call_user_func_array([$this, $alias], $arguments);
    }

    /**
     * Get the value of the merchant parameter
     *
     * @return string
     */
    public function getMerchant()
    {
        return $this->getParameter('merchant');
    }

    /**
     * Set the value of the merchant parameter
     *
     * @param  string $value
     *
     * @return $this
     */
    public function setMerchant($value)
    {
        return $this->setParameter('merchant', $value);
    }

    /**
     * Get te value of the accessCode parameter
     *
     * @return string
     */
    public function getAccessCode()
    {
        return $this->getParameter('accessCode');
    }

    /**
     * Set the value of the accessCode parameter
     *
     * @param  string $value
     *
     * @return $this
     */
    public function setAccessCode($value)
    {
        return $this->setParameter('accessCode', $value);
    }

    /**
     * Get the value of the hashCode parameter
     *
     * @return string
     */
    public function getHashCode()
    {
        return $this->getParameter('hashCode');
    }

    /**
     * Set the value of the hashCode parameter
     *
     * @param  string $value
     *
     * @return $this
     */
    public function setHashCode($value)
    {
        return $this->setParameter('hashCode', $value);
    }

    /**
     * Get the value of the user parameter
     *
     * @return string
     */
    public function getUser()
    {
        return $this->getParameter('user');
    }

    /**
     * Set the value of the user parameter
     *
     * @param  string $value
     *
     * @return $this
     */
    public function setUser($value)
    {
        return $this->setParameter('user', $value);
    }

    /**
     * Get the value of the password parameter
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getParameter('password');
    }

    /**
     * Set the value of the password parameter
     *
     * @param  string $value
     *
     * @return $this
     */
    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }
}
