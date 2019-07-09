var documents = new Vue({
    data: {
        document: {
            datas: null,
            lastPage: 0,
            total: 0,
            pagination: 1
        }
    },
    methods: {
        refresh_documents: function() {
            $(".loader").slideDown("slow");
            $("[data]").slideUp("slow");

            var docid = "%" + $("#documents [name=docid]").val() + "%";
            var type = $("#documents [name=type]:checked").val();
            var status = $("#documents [name=status]:checked").val();

            $.ajax({
                type: "post",
                url: "/document/get",
                data: {
                    token: app.token,
                    docid: docid,
                    type: type,
                    status: status,
                    page: documents.document.pagination
                },
                success: function(response) {
                    documents.document.datas = response.data.items;
                    documents.document.lastPage = response.data.lastPage;
                    documents.document.total = response.data.total;

                    $(".loader").slideUp("slow");
                    $("[data]").slideDown("slow");
                },
                error: function() {
                    documents.refresh_document_datas();
                }
            });
        },
        refresh_document_datas: function() {
            documents.document.pagination = 1;
            documents.refresh_documents();
            scrollTo($(".portlet"));
        },
        refresh_document_prev: function() {
            if (documents.document.pagination > 1) {
                documents.document.pagination--;
            }
            documents.refresh_documents();
        },
        refresh_document_next: function() {
            if (documents.document.pagination < documents.document.lastPage) {
                documents.document.pagination++;
            }
            documents.refresh_documents();
        },
        handle_detail: function(index) {
            sessionStorage.setItem(
                "document",
                JSON.stringify(documents.document.datas[index])
            );
            window.location = "/details";
        },
        handle_change_status: function(index, status) {
            var data = documents.document.datas[index];
            var message = `<b>${
                data.docid
            }</b> status will be change to be <b>${status}</b>`;
            bootbox.confirm(message, function(callback) {
                if (callback) {
                    $.ajax({
                        async: false,
                        type: "patch",
                        url: "/document/approved",
                        data: {
                            token: app.token,
                            doctype: data.type,
                            docid: data.docid,
                            deptcd: data.deptcd,
                            status: status,
                            docdate: data.docdate,
                            seqno: data.seqno
                        },
                        success: function(response) {
                            showAlert("success", response.message);
                            documents.refresh_documents();
                        },
                        error: function(response) {
                            showAlert("error", response.responseJSON.message);
                        }
                    });
                    scrollTo($(".portlet"));
                }
            });
        }
    }
});

$(document).ready(function() {
    sessionStorage.removeItem("document");
    setTimeout(function() {
        documents.refresh_documents();
        scrollTo($(".portlet"));
    }, 1000);
});
