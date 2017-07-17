<?php

namespace classifieds\maciej\hermes\client\subscriber;

interface HermesRequestInterface
{
    /**
     * @return string
     */
    public function getBody(): string;

    /**
     * @return array
     */
    public function getHeaders(): array;
}