<?php

namespace SgcAdmin\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SgcAdmin\Http\Requests;
use SgcAdmin\Http\Requests\CustomerContractsRequest;
use SgcAdmin\Repositories\CustomerContractsRepository;
use SgcAdmin\Repositories\OperatorRepository;

class CustomerContractsController extends Controller
{
    private $breadcrumbs;
    private $operatorRepository;
    /**
     * @var CustomerContractsRepository
     */
    private $customerContractsRepository;

    public function __construct(CustomerContractsRepository $customerContractsRepository, OperatorRepository $operatorRepository)
    {
        $this->breadcrumbs = [
            'title' => 'Contratos',
            'page' => 'Cadastros',
            'fa' => 'fa-users'
        ];

        $this->operatorRepository = $operatorRepository;
        $this->customerContractsRepository = $customerContractsRepository;
    }

    public function index()
    {
        $contracts = $this->customerContractsRepository->all();
        $operators = $this->operatorRepository->all()->pluck('name','id');

        return view(
            'admin.customer-contracts.index',
            $this->breadcrumbs,
            compact('contracts', 'operators')
        );
    }

    public function store(CustomerContractsRequest $request)
    {
        $contract = $request->all();

        $contract['start_date'] = formatDate($contract['start_date'], 'db');
        $contract['end_date'] = formatDate($contract['end_date'], 'db');
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
        $contracts = $this->customerContractsRepository->all();
        $contractEdit = $this->customerContractsRepository->find($id);
        $operators = $this->operatorRepository->all()->pluck('name','id');

        return view(
            'admin.customer-contracts.index',
            $this->breadcrumbs,
            compact('contracts', 'contractEdit', 'operators')
        );
    }

    public function update(CustomerContractsRequest $request, $id)
    {
        $contract = $request->all();
        $contract['start_date'] = formatDate($contract['start_date'], 'db');
        $contract['end_date'] = formatDate($contract['end_date'], 'db');
        $contract['user_id'] = Auth::user()->id;

        $this->operatorRepository->update($request->all(), $id);
        return redirect()->route('admin.contract.index');
    }
}
