<?php namespace Omnipay\OnePay\Message;

/**
 * The DomesticCompletePurchaseResponse class
 */
class DomesticCompletePurchaseResponse extends Response
{
    /**
     * Response status codes
     *
     * @var array
     */
    protected $responseCodes = [
        '0'   => 'Approved.',
        '1'   => 'Bank declined transaction.',
        '3'   => 'Merchant is not exist.',
        '4'   => 'Invalid access code.',
        '5'   => 'Invalid amount.',
        '6'   => 'Invalid currency code.',
        '7'   => 'Unspecified failure.',
        '8'   => 'Invalid card number.',
        '9'   => 'Invalid card name.',
        '10'  => 'Expired card.',
        '11'  => 'Card not registered service (internet banking).',
        '12'  => 'Invalid card date.',
        '13'  => 'Exceed payment limit.',
        '21'  => 'Insufficient fund.',
        '22'  => 'Invalid account.',
        '23'  => 'Account lock.',
        '24'  => 'Invalid card info.',
        '25'  => 'Invalid OTP.',
        '99'  => 'User cancel transaction.',
        '253' => 'Transaction timeout.',
    ];
}