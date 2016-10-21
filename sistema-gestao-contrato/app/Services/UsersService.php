<?php

namespace SgcAdmin\Services;


use SgcAdmin\Repositories\UserRepository;

class UsersService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store($request)
    {
        $request['password'] = bcrypt($request['password']);

        return $this->userRepository->create($request);
    }
}