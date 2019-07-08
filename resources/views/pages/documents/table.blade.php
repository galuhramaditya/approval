<div class="col-md-12" vue-data>
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="icon-docs font-dark"></i>
                <span class="caption-subject bold uppercase"> demand datas </span>
            </div>
        </div>
        <div class="portlet-body" v-if="documents.document != null">
            @include("pages.documents.filter")
            @include("includes.alert")
            @include('includes.loader')
            <div class="table-scrollable display-hide" data>
                <table style="text-align: center" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="text-align: center"> </th>
                            <th style="text-align: center"> Divisi </th>
                            <th style="text-align: center"> Document No </th>
                            <th style="text-align: center"> Reference No </th>
                            <th style="text-align: center"> Date </th>
                            <th style="text-align: center"> Due Date </th>
                            <th style="text-align: center"> Request By </th>
                            <th style="text-align: center"> Notes </th>
                            <th style="text-align: center"> Status </th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="9"></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr v-show="documents.document.total == 0">
                            <td colspan="9">Document does not exist</td>
                        </tr>
                        <tr class="odd gradeX" v-for="(document, index) in documents.document.datas">
                            <td>
                                <button class="btn btn-xs sbold btn-info" v-on:click.prevent="documents.handle_detail(index)">
                                    <i class="fa fa-info"></i>
                                </button>
                            </td>
                            <td> @{{output(document.divisi)}} </td>
                            <td> @{{output(document.docid)}} </td>
                            <td> @{{output(document.refno)}} </td>
                            <td> @{{output(moment(document.docdate).format("DD MMM YYYY"))}} </td>
                            <td> @{{output(moment(document.duedate).format("DD MMM YYYY"))}} </td>
                            <td> @{{output(document.requestby)}} </td>
                            <td> @{{output(document.notes)}} </td>
                            <td class="dropup">
                                @include('includes.status', ["data" => "document", "func" => "documents.handle_change_status", "icon" => "fa fa-angle-up"])
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Total : <b>@{{documents.document.total}}</b> datas
                </div>
                <div class="col-md-6" v-if="documents.document.lastPage > 1">
                    <div class="btn-group pull-right">
                        <button class="btn sbold" v-on:click.prevent="documents.refresh_document_prev()">
                            <i class="fa fa-chevron-left"></i>
                        </button>
                        <button class="btn sbold" v-on:click.prevent="scrollTo($('.portlet'))">
                            <b>@{{documents.document.pagination}}</b>
                        </button>
                        <button class="btn sbold" v-on:click.prevent="documents.refresh_document_next()">
                            <i class="fa fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>