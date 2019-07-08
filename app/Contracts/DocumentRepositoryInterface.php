<?php

namespace App\Contracts;

interface DocumentRepositoryInterface
{
    public function getDocument(array $where, string $docid = '');

    public function getDetail(array $where, string $search = '');

    public function approved(array $data);

    public function updateDetailStatus(string $status, array $where);

    public function updateQtyapprove(array $data, array $where);

    public function getVerfy(string $docid);

    public function getPoComplete(string $docid);
}