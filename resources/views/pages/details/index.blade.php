@extends('layouts.app')

@section('css')
    <style>
        #status-filter .mt-radio {
            margin-bottom: 0;
        }
        #status-filter .mt-radio-inline {
            padding: 7px 0;
        }
    </style>
@endsection

@section('breadcrumb')
    <li v-if="details.document != null">
        <i class="fa fa-circle"></i>
        <a href="/details" vue-data>@{{details.document.docid}}</a>
    </li>
@endsection

@section('toolbar')
    <div class="btn-group pull-right">
        <button type="button" class="btn green btn-sm btn-outline" v-on:click.prevent="window.history.back()">
                <i class="fa fa-chevron-left"></i> Back
        </button>
    </div>
@endsection

@section('content')
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title uppercase">Document Details</h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row" id="documents">
        <div class="col-md-12">
            @include('pages.details.document')
        </div>
    </div>
    <div class="row" id="details" vue-data>
        <div class="col-md-12">
            @include('pages.details.detail')
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/assets/scripts/pages/details.js" type="text/javascript"></script>
@endsection