<?php

namespace SgcAdmin\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SgcAdmin\Http\Requests;
use Carbon\Carbon;
use SgcAdmin\Http\Requests\CustomerContractsRequest;
use SgcAdmin\Repositories\ContractRepository;
use SgcAdmin\Repositories\CustomerContractsRepository;
use SgcAdmin\Repositories\OperatorRepository;
use SgcAdmin\Repositories\UserRepository;

class CustomerContractsController extends Controller
{
    private $breadcrumbs;
    private $operatorRepository;
    /**
     * @var ContractsRepository
     */
    private $contractsRepository;
    /**
     * @var CustomerContractsRepository
     */
    private $customerContractsRepository;
    /**
     * @var ContractRepository
     */
    private $contractRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * CustomerContractsController constructor.
     * @param CustomerContractsRepository $customerContractsRepository
     * @param ContractRepository $contractRepository
     * @param OperatorRepository $operatorRepository
     * @param UserRepository $userRepository
     * @internal param ContractRepository $contractsRepository
     */
    public function __construct(CustomerContractsRepository $customerContractsRepository,
                                ContractRepository $contractRepository,
                                OperatorRepository $operatorRepository,
                                UserRepository $userRepository)
    {
        $this->breadcrumbs = [
            'title' => 'Clientes',
            'page' => 'Registos',
            'fa' => 'fa-users'
        ];

        $this->operatorRepository = $operatorRepository;
        $this->customerContractsRepository = $customerContractsRepository;
        $this->contractRepository = $contractRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        if(Auth::user()->role == 'admin')
        {
            $contracts = $this->customerContractsRepository->with('user')->all();
            $salesman = $this->userRepository->all()->pluck('name', 'id');
        }
        else
        {
            $contracts = $this->customerContractsRepository->with('user')->findWhere([['user_id', '=', Auth::user()->id]]);
        }

        $operators = $this->operatorRepository->all()->pluck('name','id');
        $clientType = clientType();
        $clientStatus = clientStatus();

        return view(
            'admin.customer-contracts.index',
            $this->breadcrumbs,
            compact(
                'contracts',
                'operators',
                'salesman',
                'clientType',
                'clientStatus'
            )
        );
    }

    public function store(CustomerContractsRequest $request)
    {
        $contract = $request->all();
       /* $contract['start_date'] = Carbon::createFromFormat('d/m/Y', $contract['start_date']);
        $contract['end_date'] = Carbon::createFromFormat('d/m/Y', $contract['end_date']);*/
        $contract['user_id'] = Auth::user()->id;



        $this->customerContractsRepository->create($contract);

        return redirect()->route('admin.contract.index');
    }

    public function destroy($id)
    {
        $this->customerContractsRepository->find($id)->delete();

        return redirect()->route('admin.contract.index');
    }

    public function edit($id)
    {
        if(Auth::user()->role == 'admin')
        {
            $contracts = $this->customerContractsRepository->with('contracts')->all();
            $salesman = $this->userRepository->all()->pluck('name', 'id');
        }
        else
        {
            $contracts = $this->customerContractsRepository->with('contracts')->findWhere([['user_id', '=', Auth::user()->id]]);
        }


        $contractEdit = $this->customerContractsRepository->find($id);
       /* $contractEdit->start_date = Carbon::parse($contractEdit->start_date)->format('d/m/Y');
        $contractEdit->end_date = Carbon::parse($contractEdit->end_date)->format('d/m/Y');*/
       // dd($contractEdit);
        $operators = $this->operatorRepository->all()->pluck('name','id');
        $clientType = clientType();
        $clientStatus = clientStatus();

        return view(
            'admin.customer-contracts.index',
            $this->breadcrumbs,
            compact(
                'contracts',
                'contractEdit',
                'operators',
                'salesman',
                'clientType',
                'clientStatus'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $contract = $request->all();
       /* $contract['start_date'] = Carbon::createFromFormat('Y/m/d', $contract['start_date']);
        $contract['end_date'] = Carbon::createFromFormat('Y/m/d', $contract['end_date']);*/
        $contract['user_id'] = Auth::user()->id;

        $this->customerContractsRepository->update($request->all(), $id);
        return redirect()->route('admin.contract.index');
    }
}
