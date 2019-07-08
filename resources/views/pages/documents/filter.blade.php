<div class="table-toolbar" style="margin-bottom: 10">
    <div class="row">
        <form class="col-sm-4" v-on:submit.prevent="documents.refresh_document_datas()">
            <div class="btn-group" style="width: 78%">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-search"></i>
                    </span>
                    <input type="text" class="form-control" name="docid" placeholder="Search Document No">
                </div>
            </div>
            <div class="btn-group" style="width: 20%">
                <button class="btn sbold purple form-control">
                    <i class="fa fa-refresh"></i>
                </button>
            </div>
        </form>
        <div class="col-sm-4">
            <div class="btn-group pull-right" id="status-filter">
                <div class="mt-radio-inline">
                    Type &nbsp&nbsp : &nbsp&nbsp
                    <label class="mt-radio">
                        <input type="radio" name="type" value="RQ" v-on:change="documents.refresh_document_datas()" checked> RQ
                        <span></span>
                    </label>
                    <label class="mt-radio">
                        <input type="radio" name="type" value="PO" v-on:change="documents.refresh_document_datas()"> PO
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="btn-group pull-right" id="status-filter">
                <div class="mt-radio-inline">
                    Status &nbsp&nbsp : &nbsp&nbsp
                    <label class="mt-radio">
                        <input type="radio" name="status" value="open" v-on:change="documents.refresh_document_datas()" checked> Open
                        <span></span>
                    </label>
                    <label class="mt-radio">
                        <input type="radio" name="status" value="approved" v-on:change="documents.refresh_document_datas()"> Approved
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>