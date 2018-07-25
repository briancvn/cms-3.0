<?php

namespace CMS\Infrastructure\Controller;

use CMS\Infrastructure\Contract\AuthRequestDto;
use CMS\Infrastructure\Contract\AuthenticateDto;
use CMS\Infrastructure\Contract\SignUpRequestDto;
use CMS\Infrastructure\Service\UserService;

class AuthenticateController extends ApiController
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    public function IsAuthenticated(): ?AuthenticateDto
    {
        return $this->userService->isAuthenticated();
    }

    /** @Post */
    public function SignIn(AuthRequestDto $requestDto): AuthenticateDto
    {
        return $this->userService->signIn($requestDto);
    }

    /** @Post */
    public function SignUp(SignUpRequestDto $requestDto): AuthenticateDto
    {
        return $this->userService->signUp($requestDto);
    }

    public function SignOut()
    {
        return $this->userService->signOut();
    }
}
