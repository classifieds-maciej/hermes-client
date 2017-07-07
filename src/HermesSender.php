<?php
namespace classifieds\maciej\hermes\client;

interface HermesSender
{
    public function send(string $uri, HermesMessage $message): HermesResponse;
}