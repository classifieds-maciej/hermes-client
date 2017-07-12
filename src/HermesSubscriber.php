<?php

namespace classifieds\maciej\hermes\client;

use classifieds\maciej\hermes\client\subscriber\HermesReceivedMessage;
use classifieds\maciej\hermes\client\subscriber\HermesReceivedMessageFactory;
use classifieds\maciej\hermes\client\subscriber\HermesRequestInterface;

class HermesSubscriber
{
    /**
     * @var HermesReceivedMessageFactory
     */
    private $messageFactory;

    /**
     * HermesSubscriber constructor.
     * @param HermesReceivedMessageFactory $messageFactory
     */
    public function __construct(HermesReceivedMessageFactory $messageFactory = null)
    {
        $this->messageFactory = $messageFactory ?: new HermesReceivedMessageFactory();
    }

    /**
     * @param HermesRequestInterface $request
     * @return HermesReceivedMessage
     */
    public function getMessage(HermesRequestInterface $request): HermesReceivedMessage
    {
        return $this->messageFactory->create($request->getBody(), $request->getHeaders());
    }
}