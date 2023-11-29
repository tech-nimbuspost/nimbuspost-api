<?php

namespace Nimbuspackage\Nimbuspost\ServerCall;

interface Client
{
    public function setEndpoint(string $endpoint);

    public function setHeaders(string $token);

    public function get();

    public function post(array $data);

    public function responseType(string $type);

}