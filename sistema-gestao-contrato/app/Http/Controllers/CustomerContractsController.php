<?php

namespace SgcAdmin\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SgcAdmin\Http\Requests;
use Carbon\Carbon;
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
            'title' => 'Clientes',
            'page' => 'Registros',
            'fa' => 'fa-users'
        ];

        $this->operatorRepository = $operatorRepository;
        $this->customerContractsRepository = $customerContractsRepository;
    }

    public function index()
    {
        $contracts = $this->customerContractsRepository->findWhere([['user_id', '=', Auth::user()->id]]);
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
        $contract['start_date'] = Carbon::createFromFormat('d/m/Y', $contract['start_date']);
        $contract['end_date'] = Carbon::createFromFormat('d/m/Y', $contract['end_date']);
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
        $contracts = $this->customerContractsRepository->findWhere([['user_id', '=', Auth::user()->id]]);
        $contractEdit = $this->customerContractsRepository->find($id);
        $contractEdit->start_date = Carbon::parse($contractEdit->start_date)->format('d/m/Y');
        $contractEdit->end_date = Carbon::parse($contractEdit->end_date)->format('d/m/Y');
       // dd($contractEdit);
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
        $contract['start_date'] = Carbon::createFromFormat('Y/m/d', $contract['start_date']);
        $contract['end_date'] = Carbon::createFromFormat('Y/m/d', $contract['end_date']);
        $contract['user_id'] = Auth::user()->id;

        $this->operatorRepository->update($request->all(), $id);
        return redirect()->route('admin.contract.index');
    }

    public function contracts()
    {
        return $contracts = $this->customerContractsRepository->findWhere([['user_id', '=', Auth::user()->id], ['end_date', '>=', Carbon::now()->toDateString()], ['end_date', '<=', Carbon::now()->addDays(30)->toDateString()]])->count();
    }
}
