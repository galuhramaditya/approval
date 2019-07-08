<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Document
{
    public static function getDocument(array $where, string $docid = '')
    {
        return DB::table('pjttrhd as hd')
            ->select("dept.name as divisi", "verfy.seqno", "hd.docid", "hd.deptcd", "hd.refno", "hd.docdate", "hd.duedate", "hd.requestby", "hd.notes", "verfy.approvests as status", "hd.type")
            ->join("samdept as dept", function ($join) {
                $join->on("dept.cocd", "=", "hd.cocd");
                $join->on("dept.deptcd", "=", "hd.deptcd");
            })
            ->join("pjtverfy as verfy", function ($join) {
                $join->on("verfy.cocd", "=", "hd.cocd");
                $join->on("verfy.doctype", "=", "hd.type");
                $join->on("verfy.docid", "=", "hd.docid");
            })
            ->join("samuser as user", function ($join) {
                $join->on("user.usercd", "=", "verfy.usercd");
            })
            ->where($where)
            ->where(function ($query) use ($docid) {
                $query->where("hd.docid", "like", $docid);
            })
            ->orderByDesc("hd.docdate")
            ->orderByDesc("hd.duedate")
            ->paginate(20);
    }

    public static function getDetail(array $where, string $search = '')
    {
        return DB::table('pjttrdt as dt')
            ->select("dt.stockcd", "dt.stocknm", "dt.unitcd", "dt.qty", "dt.qtyapprove", "dt.status", "dt.notes")
            ->join("pjttrhd as hd", function ($join) {
                $join->on("hd.cocd", "=", "dt.cocd");
                $join->on("hd.type", "=", "dt.type");
                $join->on("hd.docid", "=", "dt.docid");
            })
            ->where($where)
            ->where(function ($query) use ($search) {
                $query->where("dt.stockcd", "like", "%" . $search . "%")
                    ->orWhere("dt.stocknm", "like", "%" . $search . "%");
            })
            ->paginate(20);
    }

    public static function approved(array $data)
    {
        return DB::statement("EXEC  dbo.PJ_Approved ?,?,?,?,?,?,?,?,?", [$data['cocd'], $data['doctype'], $data['docid'], $data['deptcd'], $data['status'], $data['docdate'], $data['usercd'], Date("Y-m-d"), $data['seqno']]);
    }

    public static function updateDetailStatus(string $status, array $where)
    {
        return DB::table('pjttrdt')
            ->where($where)
            ->update(["status" => $status]);
    }

    public static function updateQtyapprove(array $data, array $where)
    {
        return DB::table('pjttrdt')
            ->where($where)
            ->update($data);
    }

    public static function getVerfy(string $docid)
    {
        return DB::table('pjtverfy')
            ->where(["docid" => $docid])
            ->orderBy("seqno")
            ->get();
    }

    public static function getPoComplete(string $docid)
    {
        return DB::table('pjttrhd')
            ->where(["frdocid" => $docid])
            ->first();
    }
}