// hide modal and reset it or not
refreshModal = function(role, reset = true) {
    modal = $("[modal-action=" + role + "]");
    modal.each(function() {
        $(this).modal("hide");
        $(this)
            .find("[name]")
            .each(function() {
                if (reset) {
                    if ($(this).is("[type=radio]")) {
                        $(this).removeAttr("checked");
                    } else {
                        $(this).val("");
                    }
                }
            });
    });
    hideFormAlert();
};

// open modal
openModal = function(role, reset = true) {
    modal = $("[modal-action=" + role + "]");
    modal.each(function() {
        $(this).modal("show");
        $(this)
            .find("[name]")
            .each(function() {
                if (reset) {
                    if ($(this).is("[type=radio]")) {
                        $(this).removeAttr("checked");
                    } else {
                        $(this).val("");
                    }
                }
            });
    });
    hideFormAlert();
};

// show alert component
showAlert = function(alert, data) {
    var el = $(".alert[alert-action=" + alert + "]");
    el.find("span").remove();
    el.append("<span>" + data + "</span>");
    el.slideDown("slow");
    setTimeout(function() {
        el.slideUp("slow");
    }, 5000);
};

// show form alert from form
showFormAlert = function(form, data) {
    for (key in data) {
        form.find(".help-block[help-name=" + key + "]")
            .html(data[key])
            .slideDown("slow");
    }
};

// hide all form alert
hideFormAlert = function() {
    $(".help-block").slideUp("slow");
};

// scroll to dest
scrollTo = function(dest) {
    $("html, body").animate(
        {
            scrollTop: dest.offset().top
        },
        1000
    );
};

// daterangepicker
get_startDate = function(selector, format) {
    return $(selector)
        .data("daterangepicker")
        .startDate.format(format);
};
get_endDate = function(selector, format) {
    return $(selector)
        .data("daterangepicker")
        .endDate.format(format);
};

// init url
initURL = function(path, host) {
    while (path[0] == "/") {
        path = path.slice(1);
    }

    return `${host}/${path}`;
};
