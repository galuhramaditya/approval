<?php

namespace App\Services;

use App\Contracts\DocumentRepositoryInterface;
use App\Traits\DataLayer;
use App\Exceptions\MessageException;

class DocumentService
{
    protected $documentRepository;
    use DataLayer;

    public function __construct(DocumentRepositoryInterface $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }

    public function getDocument(array $where, string $docid = '')
    {
        $data = [
            "hd.cocd" => $where["token"]["cocd"],
            "user.usercd" => $where["token"]["usercd"],
            "hd.type" => $where["type"]
        ];

        if (array_key_exists("status", $where)) {
            $data["verfy.approvests"] = $where["status"];
        }

        return $this->documentRepository->getDocument($data, $docid);
    }

    public function getDetail(array $where, string $search = '')
    {
        $data = [
            "hd.cocd" => $where["token"]["cocd"],
            "hd.docid" => $where["docid"],
            "hd.type" => $where["type"]
        ];

        return $this->documentRepository->getDetail($data, $search);
    }

    public function approved(array $data)
    {
        $this->document_validation($data);

        $data = [
            "cocd"      => $data["token"]["cocd"],
            "deptcd"    => $data['deptcd'],
            "status"    => $data['status'],
            "docid"     => $data['docid'],
            "usercd"    => $data["token"]["usercd"],
            "doctype"   => $data['doctype'],
            "docdate"   => Date("Y-m-d", strtotime($data["docdate"])),
            "seqno"     => count($this->documentRepository->getVerfy($data["docid"])),
        ];
        return $this->documentRepository->approved($data);
    }

    public function updateDetailStatus(string $status, array $where)
    {
        $this->document_validation($where);

        $where = [
            "docid"     => $where["docid"],
            "stockcd"   => $where["stockcd"],
            "cocd"      => $where["token"]["cocd"],
        ];
        return $this->documentRepository->updateDetailStatus($status, $where);
    }

    public function updateQtyapprove(array $data, array $where)
    {
        $this->document_validation($where);

        $where = [
            "docid"     => $where["docid"],
            "stockcd"   => $where["stockcd"],
            "cocd"      => $where["token"]["cocd"],
        ];

        return $this->documentRepository->updateQtyapprove($data, $where);
    }

    private function document_validation(array $data)
    {
        $get_varify = $this->documentRepository->getVerfy($data["docid"]);
        if ($data["seqno"] > 1) {
            if ($get_varify[$data["seqno"] - 2]->ApproveSts != "Approved") {
                throw new MessageException("prevous user has not approved yet");
            }
            if ($data["seqno"] < count($get_varify) && $get_varify[$data["seqno"]]->ApproveSts != "Open") {
                throw new MessageException("transactions has been approved by next user");
            }
        }

        if ($data["doctype"] == "RQ") {
            $get_po_complete = $this->documentRepository->get_po_complete($data["docid"]);
            if ($get_po_complete) {
                return $this->callout(false, "has been PO completely");
            }
        }
    }
}