$(function(){
    $(".tag-delete").click(function(){
        let tagId = $(this).closest("tr").find("td").first().text();
        let isConfirm = confirm("Tag id: " + tagId + "\nAre you sure to delete this tag?");

        if(isConfirm == true) {
            let btnSubmit = $(this).closest("td").find(".confirm-delete").first();
            btnSubmit.submit();
        }
    });
});
