<?php

namespace SgcAdmin\Http\Controllers;

use Illuminate\Http\Request;

use SgcAdmin\Http\Requests;
use SgcAdmin\Http\Requests\OperatorsRequest;
use SgcAdmin\Repositories\OperatorRepository;

class OperatorsController extends Controller
{
    private $breadcrumbs;
    private $operatorRepository;

    public function __construct(OperatorRepository $operatorRepository)
    {
        $this->breadcrumbs = [
            'title' => 'Operadoras',
            'page' => 'Registos',
            'fa' => 'fa-building-o'
        ];

        $this->operatorRepository = $operatorRepository;
    }

    public function index()
    {
        $operators = $this->operatorRepository->all();

        return view(
            'admin.operators.index',
            $this->breadcrumbs,
            compact('operators')
        );
    }

    public function store(OperatorsRequest $request)
    {
        $this->operatorRepository->create($request->all());

        return redirect()->route('admin.operator.index');
    }

    public function destroy($id)
    {
        $this->operatorRepository->find($id)->delete();

        return redirect()->route('admin.operator.index');
    }

    public function edit($id)
    {
        $operators = $this->operatorRepository->all();
        $operatorEdit = $this->operatorRepository->find($id);

        return view(
            'admin.operators.index',
            $this->breadcrumbs,
            compact('operators', 'operatorEdit')
        );
    }

    public function update(OperatorsRequest $request, $id)
    {
        $this->operatorRepository->update($request->all(), $id);
        return redirect()->route('admin.operator.index');
    }
}
