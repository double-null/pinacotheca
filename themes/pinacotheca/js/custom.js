$('.drop').click( function (e) {
    let drop_url = $(this).attr('href');
    $.ajax({
        type: "GET",
        url: drop_url,
        success: function(data){
            if (typeof data.error.delete !== 'undefined') {
                $('.flash-message').text(data.error.delete);
                $('.flash-message').fadeIn(600).delay(5000).fadeOut(600);
            } else {
                $('.flash-message').text('Изображение удалено успешно!');
                $('.flash-message').fadeIn(600).delay(5000).fadeOut(600);
                setTimeout(function(){location.reload()}, 5000);
            }
        },
        dataType: 'json',
    });
    //
    e.preventDefault();
});