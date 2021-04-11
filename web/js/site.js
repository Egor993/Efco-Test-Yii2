$('.btn-success').on('click', function(e){
    e.preventDefault();
    let value = $(this).val();
    $.ajax({
        url: '/',
        type: 'POST',
        data: {'approve': value},
    });
    $(`.btn-success[value=${value}]`).replaceWith("<p class='success'>Утвержден</з>");
    $(`.btn-change[value=${value}]`).replaceWith("");
    return false;
});
