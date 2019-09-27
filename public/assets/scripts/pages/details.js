var details = new Vue({
    data: {
        document: null,
        detail: {
            datas: null,
            lastPage: 0,
            total: 0,
            pagination: 1
        }
    },
    watch: {
        document: function() {
            details.refresh_detail_datas();
            setTimeout(function() {
                $("[vue-data]").slideDown("slow");
            }, 500);
        }
    },
    methods: {
        refresh_document: function() {
            var document = JSON.parse(sessionStorage.getItem("document"));
            details.document = document;
        },
        refresh_details: function() {
            $(".loader").slideDown("slow");
            $("[data]").slideUp("slow");

            var search = $("input[name=search]").val();

            $.ajax({
                type: "post",
                url: "document/detail",
                data: {
                    token: app.token,
                    docid: details.document.docid,
                    type: details.document.type,
                    page: details.detail.pagination,
                    search: search
                },
                success: function(response) {
                    details.detail.datas = response.data.items;
                    details.detail.lastPage = response.data.lastPage;
                    details.detail.total = response.data.total;

                    $(".loader").slideUp("slow");
                    $("[data]").slideDown("slow");
                },
                error: function() {
                    details.refresh_details();
                }
            });
        },
        refresh_detail_datas: function() {
            details.detail.pagination = 1;
            details.refresh_details();
            scrollTo($("#details"));
        },
        handle_detail_prev: function() {
            if (app.detail.pagination > 1) {
                app.detail.pagination--;
            }
            details.refresh_details();
            scrollTo($("#details"));
        },
        handle_detail_next: function() {
            if (app.detail.pagination < app.detail.lastPage) {
                app.detail.pagination++;
            }
            details.refresh_details();
            scrollTo($("#details"));
        },
        handle_change_document_status: function(status) {
            var data = details.document;
            var message = `<b>${data.docid}</b> status will be change to be <b>${status}</b>`;

            bootbox.confirm(message, function(callback) {
                if (callback) {
                    $.ajax({
                        async: false,
                        type: "patch",
                        url: "document/approved",
                        data: {
                            token: app.token,
                            doctype: data.type,
                            docid: data.docid,
                            deptcd: data.deptcd,
                            docdate: data.docdate,
                            seqno: data.seqno,
                            status: status
                        },
                        success: function(response) {
                            showAlert("success", response.message);
                            details.document.status = status;
                        },
                        error: function(response) {
                            showAlert("error", response.responseJSON.message);
                        }
                    });
                    scrollTo($("#app"));
                }
            });
        },
        handle_change_detail_status: function(index, status) {
            var stockcd = details.detail.datas[index].stockcd;
            var message = `<b>${stockcd}</b> status will be change to be <b>${status}</b>`;

            bootbox.confirm(message, function(callback) {
                if (callback) {
                    $.ajax({
                        async: false,
                        type: "patch",
                        url: "document/detail/change-detail-status",
                        data: {
                            token: app.token,
                            status: status,
                            stockcd: stockcd,
                            seqno: details.document.seqno,
                            doctype: details.document.type,
                            docid: details.document.docid
                        },
                        success: function(response) {
                            showAlert("success", response.message);
                            details.refresh_details();
                        },
                        error: function(response) {
                            showAlert("error", response.responseJSON.message);
                        }
                    });
                    scrollTo($("#app"));
                }
            });
        },
        handle_update_qtyapprove: function(index) {
            var form = $(`[account-form=update-qtyapprove-${index}]`);
            var qtyapprove = form.find("input[name=qtyapprove]").val();
            var notes = form.find("input[name=notes]").val();

            hideFormAlert();

            $.ajax({
                type: "patch",
                url: "document/detail/update-qtyapprove",
                data: {
                    token: app.token,
                    docid: details.document.docid,
                    stockcd: details.detail.datas[index].stockcd,
                    seqno: details.document.seqno,
                    doctype: details.document.type,
                    qtyapprove: qtyapprove,
                    notes: notes
                },
                success: function(response) {
                    showAlert("success", response.message);
                    refreshModal("update-qtyapprove");
                    details.refresh_details();
                    scrollTo($("#app"));
                },
                error: function(response) {
                    if (response.responseJSON.hasOwnProperty("data")) {
                        showFormAlert(form, response.responseJSON.data);
                    } else {
                        showAlert("error", response.responseJSON.message);
                        refreshModal("update-qtyapprove");
                        scrollTo($("#app"));
                    }
                }
            });
        }
    }
});

$(document).ready(function() {
    if (!sessionStorage.hasOwnProperty("document")) {
        window.location = "index.php";
    }
    setTimeout(function() {
        details.refresh_document();
        scrollTo($(".portlet"));
    }, 1000);
});
