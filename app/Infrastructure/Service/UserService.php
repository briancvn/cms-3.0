<?php
namespace CMS\Infrastructure\Service;

use CMS\Infrastructure\Extension\Auth\Session;
use CMS\Infrastructure\Repository\UserRepository;
use CMS\Infrastructure\Domain\User;
use CMS\Infrastructure\Contract\AuthRequestDto;
use CMS\Infrastructure\Contract\AuthenticateDto;
use CMS\Infrastructure\Contract\ProfileDto;
use CMS\Infrastructure\Contract\UserSearchResultDto;
use CMS\Infrastructure\Contract\UserDto;
use CMS\Infrastructure\Contract\SignUpRequestDto;

class UserService extends GenericService
{
    public function __construct(UserRepository $userRepository) {
        parent::__construct($userRepository, UserSearchResultDto::class, UserDto::class);
    }

    protected function IsAuthenticated(): ?AuthenticateDto
    {
        $session = $this->authManager->getSession();
        return $this->responseAuthenticateDto($session);
    }

    protected function signIn(AuthRequestDto $requestDto): ?AuthenticateDto
    {
        $user = $this->repository->findOneByAuthRequest($requestDto->Username);
        return $this->responseAuthenticateDto($this->authManager->signIn($this->mapper->map($user, User::class), $requestDto->Password));
    }

    protected function signUp(SignUpRequestDto $requestDto): ?AuthenticateDto
    {
        $user = $this->repository->findOneByAuthRequest($requestDto->Username);
        return $this->responseAuthenticateDto($this->authManager->signIn($user, $requestDto->Password));
    }

    protected function signOut()
    {
        $this->authManager->signOut();
    }

    private function responseAuthenticateDto(?Session $session) : ?AuthenticateDto
    {
        if ($session && $session->isAuthenticated()) {
            return new AuthenticateDto([
                Token => $session->getToken(),
                Expires => $session->getExpirationTime(),
                RoleGroups => $session->getUser()->RoleGroups,
                Profile => $this->mapper->map($session->getUser()->Profile, ProfileDto::class)
            ]);
        }
        return null;
    }
}
