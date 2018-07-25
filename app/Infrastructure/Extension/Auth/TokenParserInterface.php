<?php

namespace CMS\Infrastructure\Extension\Auth;

interface TokenParserInterface
{
    public function getToken(Session $session);
    public function getSession($token);
}
