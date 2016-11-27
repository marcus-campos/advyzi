<?php

namespace SgcAdmin\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SgcAdmin\Http\Requests;
use SgcAdmin\Http\Requests\UsersRequest;
use SgcAdmin\Repositories\ContractRepository;
use SgcAdmin\Repositories\CustomerContractsRepository;
use SgcAdmin\Repositories\UserRepository;
use SgcAdmin\Services\UsersService;

class UsersController extends Controller
{
    private $breadcrumbs;
    private $userRepository;
    /**
     * @var UsersService
     */
    private $usersService;
    /**
     * @var CustomerContractsRepository
     */
    private $customerContractsRepository;

    /**
     * UsersController constructor.
     * @param UserRepository $userRepository
     * @param UsersService $usersService
     * @param CustomerContractsRepository $customerContractsRepository
     * @internal param ContractRepository $contractRepository
     */
    public function __construct(UserRepository $userRepository, UsersService $usersService, CustomerContractsRepository $customerContractsRepository)
    {
        $this->breadcrumbs = [
            'title' => 'Utilizadores',
            'page' => 'Registos',
            'fa' => 'fa-users'
        ];

        $this->userRepository = $userRepository;
        $this->usersService = $usersService;
        $this->customerContractsRepository = $customerContractsRepository;
    }

    public function index()
    {
        if(Auth::user()->role == 'admin')
            $users = $this->userRepository->all();
        else
            $users = $this->userRepository->findWhere([['role', '<>', 'admin']]);

        return view(
            'admin.users.index',
            $this->breadcrumbs,
            compact('users')
        );
    }

    public function store(UsersRequest $request)
    {
        $this->usersService->store($request->all());

        return redirect()->route('admin.user.index');
    }

    public function transfer($userToDelete)
    {
        $users = $this->userRepository->findWhere([['id', '<>', $userToDelete]]);

        return view(
            'admin.users.index',
            $this->breadcrumbs,
            compact('users', 'userToDelete')
        );
    }

    public function destroy(Request $request, $id)
    {
        $contracts = $this->customerContractsRepository->findWhere([['user_id', '=', $id]]);

        $newContracts = null;

        if($contracts->count() > 0) {

            foreach ($contracts as $contract)
            {
                $newContracts[] = $contract['user_id'] = $request['userToTransfer'];
            }

            $this->customerContractsRepository->updateOrCreate([['user_id', '=', $id]], $newContracts);
        }

        $this->userRepository->find($id)->delete();

        return redirect()->route('admin.user.index');
    }

    public function edit($id)
    {
        if(Auth::user()->role == 'admin')
            $users = $this->userRepository->all();
        else
            $users = $this->userRepository->findWhere([['role', '<>', 'admin']]);

        $userEdit = $this->userRepository->find($id);

        return view(
            'admin.users.index',
            $this->breadcrumbs,
            compact('users', 'userEdit')
        );
    }

    public function update(Request $request, $id)
    {
        $this->usersService->update($request->all(), $id);

        return redirect()->route('admin.user.index');
    }
}
