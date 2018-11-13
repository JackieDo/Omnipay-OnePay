<?php namespace Omnipay\OnePay\Message;

/**
 * The InternationalCompletePurchaseResponse class
 */
class InternationalCompletePurchaseResponse extends Response
{
    /**
     * Response status codes
     *
     * @var array
     */
    protected $responseCodes = [
        '0'  => 'Transaction is successful.',
        '1'  => 'Issuer Bank declined the transaction. Please contact Issuer Bank.',
        '2'  => 'Your credit account is insufficient funds or not registered for online payment service.',
        '3'  => 'No reply from bank.',
        '4'  => 'Your card is expired.',
        '5'  => 'Your credit account is insufficient funds.',
        '6'  => 'Error from Issuer Bank..',
        '7'  => 'Error when processing transaction.',
        '8'  => 'Issuer Bank does not support E-commerce transaction.',
        '9'  => 'Issuer Bank declined the transaction. Please contact Issuer Bank.',
        '99' => 'User cancel.',
        'A'  => 'Transaction aborted.',
        'B'  => 'Cannot authenticated by 3D-Secure Program. Please contact Issuer Bank.',
        'C'  => 'Transaction cancelled.',
        'D'  => 'Deferred transaction has been received and is awaiting processing.',
        'E'  => 'Wrong CSC entered or Issuer Bank declined the transaction. Please contact Issuer Bank.',
        'F'  => '3D secure authentication failed.',
        'I'  => 'Card security code verification failed.',
        'L'  => 'Shopping transaction locked. Please try the transaction again later.',
        'N'  => 'Cardholder is not enrolled in authentication scheme.',
        'P'  => 'Transaction has been received by the payment adaptor and is being processed.',
        'R'  => 'Transaction was not processed - reached limit of retry attempts allowed.',
        'S'  => 'Duplicate sessionid (order info).',
        'T'  => 'Address verification failed.',
        'U'  => 'Card security code failed.',
        'V'  => 'Address verification and card security code failed.',
        'Z'  => 'Transaction was block by OFD.',
    ];
}