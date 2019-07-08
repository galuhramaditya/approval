<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DocumentService;
use App\Libraries\Response;
use App\Libraries\Validation;
use Illuminate\Auth\Access\Response as IlluminateResponse;

class DocumentController extends Controller
{
    private $documentService;
    private $validation;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
        $this->validation = Validation::rulesOfFunction([
            "get" => [
                "docid" => "required",
                "type"  => "required",
            ],
            "detail" => [
                "docid" => "required",
                "type"  => "required",
            ],
            "approved" => [
                "doctype"   => "required|in:PO,RQ",
                "docid"     => "required",
                "deptcd"    => "required",
                "status"    => "required|in:Open,Approved,Canceled,Closed",
                "docdate"   => "required",
                "seqno"     => "required",
            ],
            "change_detail_status" => [
                "stockcd"   => "required",
                "docid"     => "required",
                "doctype"   => "required",
                "seqno"     => "required",
                "status"    => "required|in:Open,Approved,Canceled",
            ],
            "update_qtyapprove" => [
                "docid"         => "required",
                "qtyapprove"    => "required|numeric",
                "doctype"       => "required",
                "notes"         => "required",
                "seqno"         => "required",
                "stockcd"       => "required",
            ],
        ]);
    }

    public function get(Request $request)
    {
        $this->validation->validate($request);

        $document = $this->documentService->getDocument($request->all(), $request->docid);
        return Response::success("document datas", $document);
    }

    public function detail(Request $request)
    {
        $this->validation->validate($request);

        $detail = $this->documentService->getDetail($request->all(), $request->search);
        return Response::success("detail datas", $detail);
    }

    public function approved(Request $request)
    {
        $this->validation->validate($request);

        $approved = $this->documentService->approved($request->all());
        return Response::success("change status successfully", $approved["data"]);
    }

    public function change_detail_status(Request $request)
    {
        $this->validation->validate($request);

        $change_detail_status = $this->documentService->updateDetailStatus($request->status, $request->all());
        return Response::success("change detail status successfully", $change_detail_status);
    }

    public function update_qtyapprove(Request $request)
    {
        $this->validation->validate($request);

        $update_qtyapprove = $this->documentService->updateQtyapprove([
            "qtyapprove" => $request->qtyapprove,
            "notes" => $request->notes
        ], $request->all());
        return Response::success("update quantity approve successfully", $update_qtyapprove);
    }
}