<?php

namespace SgcAdmin\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Session;
use SgcAdmin\Http\Requests;
use Carbon\Carbon;
use SgcAdmin\Http\Requests\CustomerContractsRequest;
use SgcAdmin\Repositories\ContractRepository;
use SgcAdmin\Repositories\CustomerRepository;
use SgcAdmin\Repositories\OperatorRepository;
use SgcAdmin\Repositories\UserRepository;

class CustomerController extends Controller
{
    private $breadcrumbs;
    private $operatorRepository;
  
    /**
     * @var CustomerRepository
     */
    private $customerRepository;
    /**
     * @var ContractRepository
     */
    private $contractRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;


    /**
     * CustomerController constructor.
     * @param \SgcAdmin\Http\Controllers\CustomerRepository $customerRepository
     * @param ContractRepository $contractRepository
     * @param OperatorRepository $operatorRepository
     * @param UserRepository $userRepository
     */
    public function __construct(CustomerRepository $customerRepository,
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
        $this->customerRepository = $customerRepository;
        $this->contractRepository = $contractRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        if(Auth::user()->role == 'admin')
        {
            $contracts = $this->customerRepository->with('user')->all();
            $salesman = $this->userRepository->all()->pluck('name', 'id');
        }
        else
        {
            $contracts = $this->customerRepository->with('user')->findWhere([['user_id', '=', Auth::user()->id]]);
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
        if(Auth::user()->role != 'admin')
            $contract['user_id'] = Auth::user()->id;



        $this->customerRepository->create($contract);

        Session::flash('success', 'Cliente armazenado com sucesso!');

        return redirect()->route('admin.contract.index');
    }

    public function destroy($id)
    {
        $this->customerRepository->find($id)->delete();

        Session::flash('warning', 'Cliente apagado com sucesso!');

        return redirect()->route('admin.contract.index');
    }

    public function edit($id)
    {
        if(Auth::user()->role == 'admin')
        {
            $contracts = $this->customerRepository->with('contracts')->all();
            $salesman = $this->userRepository->all()->pluck('name', 'id');
        }
        else
        {
            $contracts = $this->customerRepository->with('contracts')->findWhere([['user_id', '=', Auth::user()->id]]);
        }


        $contractEdit = $this->customerRepository->find($id);
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

        $this->customerRepository->update($request->all(), $id);

        Session::flash('success', 'Cliente atualizado com sucesso!');

        return redirect()->route('admin.contract.index');
    }

    public function clientsAdded()
    {
        if(Auth::user()->role == 'admin')
        {
            $contracts = $this->customerRepository->with('user')->all()->count();
        }
        else
        {
            $contracts = $this->customerRepository->with('user')->findWhere([['user_id', '=', Auth::user()->id]])->count();
        }

        return $contracts;
    }
}
