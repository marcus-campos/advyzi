<?php

namespace SgcAdmin\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Exception;
use SgcAdmin\Http\Requests;
use SgcAdmin\Http\Requests\ContractRequest;
use SgcAdmin\Repositories\ContractRepository;
use SgcAdmin\Repositories\CustomerContractsRepository;
use SgcAdmin\Repositories\OperatorRepository;

class ContractsController extends Controller
{
    private $breadcrumbs;
    /**
     * @var CustomerContractsRepository
     */
    private $customerContractsRepository;
    /**
     * @var ContractRepository
     */
    private $contractRepository;
    /**
     * @var OperatorRepository
     */
    private $operatorRepository;

    /**
     * ContractsController constructor.
     * @param CustomerContractsRepository $customerContractsRepository
     * @param ContractRepository $contractRepository
     * @param OperatorRepository $operatorRepository
     */
    public function __construct(CustomerContractsRepository $customerContractsRepository,
                                ContractRepository $contractRepository,
                                OperatorRepository $operatorRepository)
    {
        $this->breadcrumbs = [
            'title' => 'Contratos',
            'page' => 'Registos',
            'fa' => 'fa-file-text-o'
        ];

        $this->customerContractsRepository = $customerContractsRepository;
        $this->contractRepository = $contractRepository;
        $this->operatorRepository = $operatorRepository;
    }

    public function index()
    {
        $operators = $this->operatorRepository->all()->pluck('name','id');

        if(Auth::user()->role == 'admin') {
            $contracts = $this->contractRepository->with('customer')
                ->all();
        }
        else {
            $contracts = $this->contractRepository->with('customer')->all();
        }

        if(Auth::user()->role == 'admin')
            $customer = $this->customerContractsRepository->all()->pluck('name', 'id');
        else
            $customer = $this->customerContractsRepository->findWhere([['user_id', '=', Auth::user()->id]])->pluck('name', 'id');


        return view(
            'admin.contracts.index',
            $this->breadcrumbs,
            compact(
                'contracts',
                'operators',
                'customer'
            )
        );
    }

    public function clientContracts($id, $callBack = '')
    {
        try {
            $operators = $this->operatorRepository->all()->pluck('name', 'id');

            $contracts = $this->contractRepository->with('customer')
                ->findWhere([['customer_contracts_id', '=', $id]]);

            if (Auth::user()->role == 'admin')
                $customer = $this->customerContractsRepository->all()->pluck('name', 'id');
            else
                $customer = $this->customerContractsRepository->findWhere([['user_id', '=', Auth::user()->id]])->pluck('name', 'id');

            $clientToAdd = $id;
            $clientModal = false;

            if(isset($contracts[0])) {

                $this->breadcrumbs = [
                    'title' => 'Contratos - ' . $contracts[0]['customer']['name'],
                    'page' => 'Registos',
                    'fa' => 'fa-file-text-o'
                ];
            }
            else
            {
                \Session::flash('warning', 'Este cliente não possui contratos.');
                return redirect()->route('admin.contract.index');
            }


            return view(
                'admin.contracts.index',
                $this->breadcrumbs,
                compact(
                    'contracts',
                    'operators',
                    'customer',
                    'clientToAdd',
                    'clientModal',
                    'callBack'
                )
            );
        }
        catch (Exception $ex)
        {
            \Session::flash('warning', 'Este cliente não possui contratos.');
            return redirect()->route('admin.contract.index');
        }


    }

    public function clientAddContracts($id)
    {
        $operators = $this->operatorRepository->all()->pluck('name','id');

        $contracts = $this->contractRepository->with('customer')
            ->findWhere([['customer_contracts_id', '=', $id]]);

        if(Auth::user()->role == 'admin')
            $customer = $this->customerContractsRepository->all()->pluck('name', 'id');
        else
            $customer = $this->customerContractsRepository->findWhere([['user_id', '=', Auth::user()->id]])->pluck('name', 'id');


        $clientToAdd = $id;
        $clientModal = true;

        return view(
            'admin.contracts.index',
            $this->breadcrumbs,
            compact(
                'contracts',
                'operators',
                'customer',
                'clientToAdd',
                'clientModal',
                'callBack'
            )
        );
    }

    public function store(ContractRequest $contractRequest)
    {
        $contractRequest['start_date'] = Carbon::createFromFormat('d/m/Y', $contractRequest['start_date']);
        $contractRequest['end_date'] = Carbon::createFromFormat('d/m/Y', $contractRequest['end_date']);
        $this->contractRepository->create($contractRequest->all());

        Session::flash('success', 'Contrato armazenado com sucesso!');
        return redirect()->route('admin.customer.contract.index');
    }

    public function edit($id, $callBack = '')
    {
        if(Auth::user()->role == 'admin') {
            $contracts = $this->contractRepository->with('customer')
                ->all();
        }
        else {
            $contracts = $this->contractRepository->with('customer')->all();
        }

        if(Auth::user()->role == 'admin')
            $customer = $this->customerContractsRepository->all()->pluck('name', 'id');
        else
            $customer = $this->customerContractsRepository->findWhere([['user_id', '=', Auth::user()->id]])->pluck('name', 'id');


        $contractEdit = $this->contractRepository->find($id);
        $contractEdit->start_date = Carbon::parse($contractEdit->start_date)->format('d-m-Y');
        $contractEdit->end_date = Carbon::parse($contractEdit->end_date)->format('d-m-Y');
        // dd($contractEdit);
        $operators = $this->operatorRepository->all()->pluck('name','id');
        $customer = $this->customerContractsRepository->findWhere([['user_id', '=', Auth::user()->id]])->pluck('name', 'id');

        return view(
            'admin.contracts.index',
            $this->breadcrumbs,
            compact(
                'contracts',
                'contractEdit',
                'operators',
                'customer',
                'callBack'
            )
        );
    }

    public function update(ContractRequest $request, $id)
    {
        $contract = $request->all();
        $contract['start_date'] = Carbon::createFromFormat('d/m/Y', $contract['start_date']);
        $contract['end_date'] = Carbon::createFromFormat('d/m/Y', $contract['end_date']);

        $this->contractRepository->update($contract, $id);

        Session::flash('success', 'Contrato atualizado com sucesso!');

        return redirect()->route('admin.customer.contract.index');
    }

    public function destroy($id, $callBack = 'admin.customer.contract.index')
    {
        $this->contractRepository->find($id)->delete();

        Session::flash('warning', 'Cliente apagado com sucesso!');
        return redirect()->route($callBack);
    }

    public function contracts()
    {
        $countContracts = 0;
        $contracts = $this->contractRepository->with('customer')->findWhere([
            ['end_date', '>', Carbon::now()->toDateString()],
            ['end_date', '<=', Carbon::now()->addDays(30)->toDateString()]
        ]);

        if($contracts->count() > 0) {

            foreach ($contracts as $contract)
            {
                if(Auth::user()->role == 'admin') {
                    $countContracts++;
                }
                else
                {
                    if ($contract['customer']['id'] == Auth::user()->id) {
                        $countContracts++;
                    }
                }
            }

            return $countContracts;
        }
        else
        {
            return 0;
        }
    }
}
