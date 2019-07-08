<?php

namespace App\Services;

use App\Contracts\CompanyRepositoryInterface;

class CompanyService
{
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function get()
    {
        return $this->companyRepository->get();
    }
}