<?php

namespace SgcAdmin\Http\Controllers;

use Carbon\Carbon;
use SgcAdmin\Repositories\ContractRepository;
use SgcAdmin\Repositories\CustomerRepository;

class DashboardController extends Controller
{
    private $breadcrumbs;
    /**
     * @var CustomerRepository
     */
    private $customerRepository;
    /**
     * @var ContractRepository
     */
    private $contractRepository;

    public function __construct(CustomerRepository $customerRepository, ContractRepository $contractRepository)
    {
        $this->breadcrumbs = [
            'title' => 'Resumo',
            'page' => 'Início',
            'fa' => 'fa-dashboard'
        ];
        $this->customerRepository = $customerRepository;
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
