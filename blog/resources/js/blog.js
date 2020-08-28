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
        handleDelete(this, 'Tag');
    });

    $(".user-delete").click(function(){
        handleDelete(this, 'User');
    });

    function handleDelete (className, name) {
        let id = $(className).closest("tr").find("td").first().text();
        let isConfirm = confirm(name + " id: " + id + "\nAre you sure to delete?");

        if (isConfirm) {
            let btnSubmit = $(className).closest("td").find(".confirm-delete").first();
            btnSubmit.submit();
        }
    }

    $('.save-post').click(function () {
        $(this).parents('form').submit();
    });

    $('#up-vote').click(handleVote);

    $('#down-vote').click(handleVote);

    function handleVote (element) {
        element = element.currentTarget;
        let voteType;

        if (!$(element).hasClass('voted-btn')) {
            $('.voted-btn').removeClass('voted-btn');
            $('.points-vote').addClass('voted-btn');
            $(element).addClass('voted-btn');
            voteType = ((element.id) == 'up-vote') ? 1 : 0;
        } else {
            $('.voted-btn').removeClass('voted-btn');
            voteType = 2;
        }

        let voteUrl = $('.votes').attr('post-vote-url');
        $.ajax ({
            url: voteUrl,
            type: 'PUT',
            data: {
                type: voteType
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('.points-vote').html(data);
            },
        });
    }

    let options = {
        root: null,
        rootMargin: '30px',
        threshold: 1
    }

    let callback = (entries, observer) => {
        if (entries[0].intersectionRatio === 1) {
            $('.votes').hide();
        } else {
            $('.votes').show();
        }
    };
      
    let observer = new IntersectionObserver(callback, options);

    let target = document.querySelector('.comments');
    observer.observe(target);
});
