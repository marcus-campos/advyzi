<?php

namespace SgcAdmin\Http\Controllers;

use Illuminate\Http\Request;

use SgcAdmin\Http\Requests;
use SgcAdmin\Http\Requests\UsersRequest;
use SgcAdmin\Repositories\UserRepository;

class UsersController extends Controller
{
    private $breadcrumbs;
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->breadcrumbs = [
            'title' => 'Usuários',
            'page' => 'Cadastros',
            'fa' => 'fa-users'
        ];

        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->findWhere([['role', '<>', 'admin']]);

        return view(
            'admin.users.index',
            $this->breadcrumbs,
            compact('users')
        );
    }

    public function store(UsersRequest $request)
    {
        $this->userRepository->create($request->all());

        return redirect()->route('admin.user.index');
    }

    public function destroy($id)
    {
        $this->userRepository->find($id)->delete();

        return redirect()->route('admin.user.index');
    }

    public function edit($id)
    {
        $users = $this->userRepository->findWhere([['role', '<>', 'admin']]);
        $userEdit = $this->userRepository->find($id);

        return view(
            'admin.users.index',
            $this->breadcrumbs,
            compact('users', 'userEdit')
        );
    }

    public function update(UsersRequest $request, $id)
    {
        $this->userRepository->update($request->all(), $id);
        return redirect()->route('admin.user.index');
    }
}
