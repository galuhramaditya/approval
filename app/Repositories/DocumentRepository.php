<?php

namespace App\Repositories;

use App\Contracts\DocumentRepositoryInterface;
use App\Models\Document;

class DocumentRepository implements DocumentRepositoryInterface
{
    public function getDocument(array $where, string $docid = '')
    {
        $get = Document::getDocument($where, $docid);
        $this->paginationLayer($get);
        return $get;
    }

    public function getDetail(array $where, string $search = '')
    {
        $get = Document::getDetail($where, $search);
        $this->paginationLayer($get);
        return $get;
    }

    public function approved(array $data)
    {
        return Document::approved($data);
    }

    public function updateDetailStatus(string $status, array $where)
    {
        return Document::updateDetailStatus($status, $where);
    }

    public function updateQtyapprove(array $data, array $where)
    {
        return Document::updateQtyapprove($data, $where);
    }

    public function getVerfy(string $docid)
    {
        return Document::getVerfy($docid);
    }

    public function getPoComplete($docid)
    {
        return Document::getPoComplete($docid);
    }

    private function paginationLayer(&$data)
    {
        $data = [
            "items" => $data->items(),
            "total" => $data->total(),
            "lastPage" => $data->lastPage()
        ];
    }
}