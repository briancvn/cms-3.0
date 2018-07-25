<?php

namespace CMS\Infrastructure\Controller;

use CMS\Infrastructure\Contract\SearchCriteriaDto;
use CMS\Infrastructure\Contract\SearchResultDto;
use CMS\Infrastructure\Contract\UserDto;
use CMS\Infrastructure\Service\UserService;

class UserController extends ApiController
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    /** @Post */
    public function Search(SearchCriteriaDto $criteria): SearchResultDto
    {
        return $this->userService->Search($criteria);
    }

    /** @Get */
    public function FindById(string $id): UserDto
    {
        return $this->userService->FindById($id);
    }
}
