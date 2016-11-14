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
        $contracts = $this->customerContractsRepository->findWhere([
            ['user_id', '=', Auth::user()->id]
        ]);
        $contracts->contracts()
            ->findWhere([
                ['end_date', '>=', Carbon::now()->toDateString()],
                ['end_date', '<=', Carbon::now()->addDays(30)->toDateString()]
            ]);

        return view(
            'admin.dashboard.index',
            $this->breadcrumbs,
            compact('contracts')
        );
    }
}
