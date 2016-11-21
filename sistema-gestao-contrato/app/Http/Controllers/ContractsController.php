<?php

namespace SgcAdmin\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
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
        $newContracts = [];
        $operators = $this->operatorRepository->all()->pluck('name','id');
        $customer = $this->customerContractsRepository->findWhere([['user_id', '=', Auth::user()->id]])->pluck('name', 'id');

        $contracts = $this->customerContractsRepository->with('contracts')->findWhere([
            ['user_id', '=', Auth::user()->id]
        ]);

        if($contracts->count() > 0) {
            $contracts = [
                "customer" => $contracts,
                "contracts" => $contracts[0]['contracts']
            ];

            foreach ($contracts['contracts'] as $contract) {
                foreach ($contracts['customer'] as $customer) {
                    if ($customer['id'] == $contract['customer_contracts_id']) {
                        $newContracts[] = [
                            'customer' => $customer,
                            'contract' => $contract
                        ];
                    }
                }

            }
        }
        else
        {
            return view(
                'admin.contracts.index',
                $this->breadcrumbs,
                compact(
                    'operators',
                    'customer'
                )
            );
        }

        $contracts = $newContracts;

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
    public function store(ContractRequest $contractRequest)
    {
        $contractRequest['start_date'] = Carbon::createFromFormat('d/m/Y', $contractRequest['start_date']);
        $contractRequest['end_date'] = Carbon::createFromFormat('d/m/Y', $contractRequest['end_date']);
        $this->contractRepository->create($contractRequest->all());

        return redirect()->route('admin.customer.contract.index');
    }

    public function edit($id)
    {
        $newContracts = null;

        $contracts = $this->customerContractsRepository->with('contracts')->findWhere([
            ['user_id', '=', Auth::user()->id]
        ]);

        $contracts = [
            "customer" =>$contracts,
            "contracts" => $contracts[0]['contracts']
        ];

        foreach ($contracts['contracts'] as $contract)
        {
            foreach ($contracts['customer'] as $customer)
            {
                if($customer['id'] == $contract['customer_contracts_id'])
                    $newContracts[] = [
                        'customer' => $customer,
                        'contract' => $contract
                    ];
            }
        }

        $contracts = $newContracts;

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
                'customer'
            )
        );
    }

    public function update(ContractRequest $request, $id)
    {
        $contract = $request->all();
        $contract['start_date'] = Carbon::createFromFormat('d/m/Y', $contract['start_date']);
        $contract['end_date'] = Carbon::createFromFormat('d/m/Y', $contract['end_date']);

        $this->contractRepository->update($contract, $id);
        return redirect()->route('admin.customer.contract.index');
    }

    public function contracts()
    {
        $contracts = $this->customerContractsRepository->with('contracts')->findWhere([
            ['user_id', '=', Auth::user()->id]
        ]);

        if($contracts->count() > 0) {
            $contracts = $contracts[0]['contracts'];

            $contracts = $contracts->where('end_date', '>=', Carbon::now()->toDateString())
                ->where('end_date', '<=', Carbon::now()->addDays(30)->toDateString())
                ->count();

            return $contracts;
        }
        else
        {
            return 0;
        }
    }
}
