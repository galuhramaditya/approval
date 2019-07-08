<?php

namespace App\Repositories;

use App\Contracts\CompanyRepositoryInterface;
use App\Models\Company;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function get()
    {
        return Company::pluck("cocd")->all();
    }
}