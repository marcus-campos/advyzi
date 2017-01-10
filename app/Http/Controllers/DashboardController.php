<?php

namespace SgcAdmin\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SgcAdmin\Http\Requests;
use SgcAdmin\Repositories\ContractRepository;
use SgcAdmin\Repositories\CustomerContractsRepository;

class DashboardController extends Controller
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

    public function __construct(CustomerContractsRepository $customerContractsRepository, ContractRepository $contractRepository)
    {
        $this->breadcrumbs = [
            'title' => 'Resumo',
            'page' => 'Início',
            'fa' => 'fa-dashboard'
        ];
        $this->customerContractsRepository = $customerContractsRepository;
        $this->contractRepository = $contractRepository;
    }

    public function index()
    {
        $contracts = $this->contractRepository->with('customer')->findWhere([
            ['end_date', '>', Carbon::now()->toDateString()],
            ['end_date', '<=', Carbon::now()->addDays(env('DAYS_TO_FILTER', 15))->toDateString()]
        ]);



        return view(
            'admin.dashboard.index',
            $this->breadcrumbs,
            compact('contracts')
        );
    }
}
