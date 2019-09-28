@extends('layouts.app')

@section('css')
<style>
    #status-filter .mt-radio {
        margin-bottom: 0;
    }

    #status-filter .mt-radio-inline {
        padding: 7px 0;
    }

    /* .btn, .btn:hover {
            color: white;
        } */
</style>
@endsection

@section('content')
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title uppercase">Documents</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row" id="documents">
    @include("pages.documents.table")
</div>
@endsection

@section('scripts')
<script src="{{ url('assets/scripts/pages/documents.js') }}" type="text/javascript"></script>
@endsection