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
        $request['commission'] = str_replace(',', '.', $request['commission']);

        return $this->userRepository->create($request);
    }

    public function update($request, $id)
    {
        $request['password'] = bcrypt($request['password']);

        return $this->userRepository->update($request, $id);
    }
}