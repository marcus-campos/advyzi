<?php

namespace SgcAdmin\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SgcAdmin\Http\Requests;
use SgcAdmin\Repositories\CustomerContractsRepository;

class DashboardController extends Controller
{
    private $breadcrumbs;
    /**
     * @var CustomerContractsRepository
     */
    private $customerContractsRepository;

    public function __construct(CustomerContractsRepository $customerContractsRepository)
    {
        $this->breadcrumbs = [
            'title' => 'Resumo',
            'page' => 'Início',
            'fa' => 'fa-dashboard'
        ];
        $this->customerContractsRepository = $customerContractsRepository;
    }

    public function index()
    {
        $newContracts = [];

        $contracts = $this->customerContractsRepository->with('contracts')->findWhere([
            ['user_id', '=', Auth::user()->id]
        ]);

        $contracts = [
            "customer" =>$contracts,
            "contracts" => $contracts[0]['contracts']
                ->where('end_date', '>=', Carbon::now()->toDateString())
                ->where('end_date', '<=', Carbon::now()->addDays(30)->toDateString())
        ];

        foreach ($contracts['contracts'] as $contract)
        {
            foreach ($contracts['customer'] as $customer)
            {
                if($customer['id'] == $contract['customer_contracts_id']) {
                    $newContracts[] = [
                        'customer' => $customer,
                        'contract' => $contract
                    ];
                }
            }

        }

        $contracts = $newContracts;

        return view(
            'admin.dashboard.index',
            $this->breadcrumbs,
            compact('contracts')
        );
    }
}
