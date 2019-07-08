var app = new Vue({
    el: "#app",
    data: {
        container: null,
        user: null,
        token: null
    },
    computed: {
        path: function() {
            return window.location.pathname;
        }
    },
    watch: {
        token: function() {
            app.refresh_user();
        }
    },
    methods: {
        output: function(data) {
            return data != "" ? data : "-";
        },
        refresh_token: function() {
            app.token = localStorage.getItem("token");
        },
        refresh_user: function() {
            app.menu = null;
            $.ajax({
                type: "post",
                url: "/user/current",
                data: {
                    token: app.token
                },
                success: function(response) {
                    app.user = response.data;

                    $("[vue-data]").slideDown("slow");
                },
                error: function() {
                    app.refresh_user();
                }
            });
        },
        handle_logout: function() {
            localStorage.removeItem("token");
            sessionStorage.removeItem("document");
            window.location = "/login";
        }
    }
});

$(document).ready(function() {
    app.refresh_token();
});
