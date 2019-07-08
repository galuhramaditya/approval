@include('includes.alert')
<div class="portlet light bordered" v-if="details.document != null">
    <div class="portlet-title">
        <div class="caption font-dark">
            <i class="icon-doc font-dark"></i>
            <span class="caption-subject bold uppercase"> document data </span>
        </div>
    </div>
    <div class="portlet-body" vue-data>
        <div class="row">
            <div class="col-xs-5 text-right">
                Divisi
            </div>
            <div class="col-xs-1" style="width: 1%"> : </div>
            <div class="col-xs-6 bold">
                    @{{output(details.document.divisi)}}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-5 text-right">
                Document No
            </div>
            <div class="col-xs-1" style="width: 1%"> : </div>
            <div class="col-xs-6 bold">
                @{{output(details.document.docid)}}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-5 text-right">
                Reference No
            </div>
            <div class="col-xs-1" style="width: 1%"> : </div>
            <div class="col-xs-6 bold">
                @{{output(details.document.refno)}}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-5 text-right">
                Date
            </div>
            <div class="col-xs-1" style="width: 1%"> : </div>
            <div class="col-xs-6 bold">
                @{{output(moment(details.document.docdate).format("DD MMMM YYYY"))}}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-5 text-right">
                Due Date
            </div>
            <div class="col-xs-1" style="width: 1%"> : </div>
            <div class="col-xs-6 bold">
                @{{output(moment(details.document.duedate).format("DD MMMM YYYY"))}}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-5 text-right">
                Request By
            </div>
            <div class="col-xs-1" style="width: 1%"> : </div>
            <div class="col-xs-6 bold">
                @{{output(details.document.requestby)}}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-5 text-right">
                Notes
            </div>
            <div class="col-xs-1" style="width: 1%"> : </div>
            <div class="col-xs-6 bold">
                @{{output(details.document.notes)}}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-5 text-right">
                Status
            </div>
            <div class="col-xs-1" style="width: 1%"> : </div>
            <div class="col-xs-6 bold">
                @include('includes.status', ["data" => "details.document", "func" => "details.handle_change_document_status", "icon" => "fa fa-angle-down", "index" => false])
            </div>
        </div>
    </div>
</div>