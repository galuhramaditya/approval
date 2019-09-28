<?php

namespace App\Http\Controllers;

use App\Services\CompanyService;
use App\Libraries\Response;

class CompanyController extends Controller
{
    private $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function get()
    {
        $get = $this->companyService->get();

        return Response::success("successfully getting company datas", $get);
    }
}
