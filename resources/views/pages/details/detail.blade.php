<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-dark">
            <i class="icon-docs font-dark"></i>
            <span class="caption-subject bold uppercase"> detail datas </span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-toolbar" style="margin-bottom: 10">
            <div class="row">
                <form class="col-sm-6" v-on:submit.prevent="details.refresh_detail_datas()">
                    <div class="btn-group" style="width: 78%">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="text" class="form-control" name="search" placeholder="Search Stock Code / Stock Description">
                        </div>
                    </div>
                    <div class="btn-group" style="width: 20%">
                        <button type="submit" class="btn sbold purple form-control">
                            <i class="fa fa-refresh"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @include('includes.loader')
        <div class="table-scrollable display-hide" data>
            <table style="text-align: center" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="text-align: center"> Stock </th>
                        <th style="text-align: center"> Stock Description </th>
                        <th style="text-align: center"> Unit </th>
                        <th style="text-align: center"> Qty RQ </th>
                        <th style="text-align: center"> Qty Approve </th>
                        <th style="text-align: center"> Status </th>
                        <th style="text-align: center"> Reason </th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="7"></th>
                    </tr>
                </tfoot>
                <tbody v-if="details.detail != null">
                    <tr v-show="details.detail.total == 0">
                        <td colspan="9">Document does not have any detail</td>
                    </tr>
                    <tr class="odd gradeX" v-for="(detail, index) in details.detail.datas">
                        <td> @{{output(detail.stockcd)}} </td>
                        <td> @{{output(detail.stocknm)}} </td>
                        <td> @{{output(detail.unitcd)}} </td>
                        <td> @{{output(detail.qty)}} </td>
                        <td>
                            <div class="col-xs-6 text-right">
                                @{{output(detail.qtyapprove)}}
                            </div>
                            <!-- Button trigger modal -->
                            <div class="col-xs-6 text-left">
                                <button type="button" class="btn btn-xs green float-right" data-toggle="modal" :data-target=`#update-qtyapprove-${index}`>
                                    <i class="fa fa-edit"></i>
                                </button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade text-left" :id=`update-qtyapprove-${index}` tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" modal-action="update-qtyapprove">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="index.html" method="post" class='modal-content' :id="index" :account-form=`update-qtyapprove-${index}` v-on:submit.prevent="details.handle_update_qtyapprove(index)">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Update Quantity Approve</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Quantity Approve</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-unlock-alt"></i>
                                                        </span>
                                                        <input type="number" min="0" :max="detail.qty" class="form-control" name="qtyapprove" :value="detail.qtyapprove" placeholder="Quantity Approve"> </div>
                                                    <div class="help-block text-danger display-hide" help-name="qtyapprove"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Notes</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-unlock-alt"></i>
                                                        </span>
                                                        <input type="text" class="form-control" name="notes" :value="detail.notes" placeholder="Reason"> </div>
                                                    <div class="help-block text-danger display-hide" help-name="notes"></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn dark" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn green">Update</button>
                                            </div>
                                        </form>
                                        <!-- /.modal-content -->
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="dropup">
                            @include('includes.status', ["data" => "detail", "func" => "details.handle_change_detail_status", "icon" => "fa fa-angle-up", "closed" => false])
                        </td>
                        <td> @{{output(detail.notes)}} </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row" v-if="details.detail != null">
            <div class="col-md-6">
                Total : <b>@{{details.detail.total}}</b> datas
            </div>
            <div class="col-md-6" v-if="details.detail.lastPage > 1">
                <div class="btn-group pull-right">
                    <button class="btn sbold" v-on:click.prevent="details.handle_detail_prev()">
                        <i class="fa fa-chevron-left"></i>
                    </button>
                    <button class="btn sbold" v-on:click.prevent="scrollTo($('#details'))" :title="`Until ${details.detail.lastPage}`">
                        <b>@{{details.detail.pagination}}</b>
                    </button>
                    <button class="btn sbold" v-on:click.prevent="details.handle_detail_next()">
                        <i class="fa fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>