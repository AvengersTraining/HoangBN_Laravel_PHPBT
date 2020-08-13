$(function(){
    let url = new URL(window.location.href),
        type = url.searchParams.get("type");
    if (type) {
        $(".nav-tag-item a").each(function () {
            $(this).removeClass("active");
        });
    }

    $(`#${type}`).addClass("active");

    $(".tag-delete").click(function(){
        handerDelete(this, 'Tag');
    });

    $(".user-delete").click(function(){
        handerDelete(this, 'User');
    });

    function handerDelete(className, name) {
        let id = $(className).closest("tr").find("td").first().text();
        let isConfirm = confirm(name + " id: " + id + "\nAre you sure to delete?");

        if (isConfirm) {
            let btnSubmit = $(className).closest("td").find(".confirm-delete").first();
            btnSubmit.submit();
        }
    }

    $(".save-post").click(function () {
        $(this).parents('form').submit();
    });
});
