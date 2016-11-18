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
        $contracts = $this->customerContractsRepository->with('contracts')->findWhere([
            ['user_id', '=', Auth::user()->id]
        ]);
        $contracts = $contracts[0]['contracts'];

        $contracts = $contracts->where('end_date', '>=', Carbon::now()->toDateString())->where('end_date', '<=', Carbon::now()->addDays(30)->toDateString());

        return view(
            'admin.dashboard.index',
            $this->breadcrumbs,
            compact('contracts')
        );
    }
}
