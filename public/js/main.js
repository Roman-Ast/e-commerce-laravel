$(function() {
    $('.list-group-item').on('click', function() {
      $('.glyphicon', this)
        .toggleClass('glyphicon-chevron-right')
        .toggleClass('glyphicon-chevron-down');
    });
  
});

$('.form-register-close').on('click', function() {
    $('.register-form').slideUp();
});

$('input[type=checkbox]').prop('checked', false);
$('.carousel-inner').children().first().addClass('active');
$('#accordion').on('change', function() {
    $('.useFilterBtnContainer').css({'display':'flex'});
});

$('.close').on('click', function () {
    $('.useFilterBtnContainer').fadeOut(400);
});

$('.selectSort').on('change', function () {
    $('.useFilterBtnContainer').fadeIn(400);
    $('.useFilterBtnContainer').css({'display': 'flex'});
    $('.useFiltera').click();
})

const arrOfCheckedCheckboxes = [];
$('.checkedCheckboxes').children().each(function() {
    arrOfCheckedCheckboxes.push($(this).attr('name'));
});

$('input[type=checkbox').each(function () {
    if (arrOfCheckedCheckboxes.includes($(this).attr('name'))) {
        $(this).parent().parent().parent().addClass('show');
        $(this).prop('checked', true);
        $('.useFilterBtnContainer').css({'display': 'flex'});
    }
});

$('.dropdown-toggle').on('click', function() {
    $('.dropdown-menu').toggle();
});

$('.card-scale').on('mouseover', function (params) {
    $(this).css({'transition': '0.2s'});
    $(this).css({'box-shadow': '2px 2px 20px 0px #bbb'});
    $(this).css({'transform': 'scale(1.05)'});
});

$('.card-scale').on('mouseleave', function (params) {
    $(this).css({'transition': '0.2s'});
    $(this).css({'box-shadow': 'none'});
    $(this).css({'transform': 'scale(1)'});
});

$('#priceFromValue').val($('#priceFromRange').val());
$('#priceFromRange').on('input', function (params) {
    $('#priceFromValue').val($(this).val());
});
$('#priceFromValue').on('input', function (params) {
    $('#priceFromRange').val($(this).val());
});

$('#priceToValue').val($('#priceToRange').val());
$('#priceToRange').on('input', function (params) {
    $('#priceToValue').val($(this).val());
});
$('#priceToValue').on('input', function (params) {
    $('#priceToRange').val($(this).val());
});

$('.show-more-reviews').children().first().on('click', function () {
    if ($(this).attr('src') === '/images/arrow-down.png') {
        $('#reviews').animate({ "height": 500 }, 500 );
        $(this).attr('src', '/images/arrow-up.png');
    } else {
        $('#reviews').animate({ "height": 200 }, 500 );
        $(this).attr('src', '/images/arrow-down.png');
    }
});

$('#reviews-tab').on('click', function () {
    $('.show-more-reviews').fadeIn().css('display', 'flex');
})

$('#contact-tab, #home-tab, #add-review-tab').on('click', function () {
    $('.show-more-reviews').css('display', 'none');
});

$('.show-form-edit').on('click', function (e) {
    e.preventDefault();
    if ($('.form-review-edit').height() > 0) {
        $('.form-review-edit').animate({'height': 0}, 200, function() {
            $(this).css({'display': 'none'});
        });
    } else {
        $('.form-review-edit').animate({'height': 200}, 200);
        $('.form-review-edit').css({'display': 'flex'});
    }
});

$('.review-delete').on('click', function (e) {
    e.preventDefault();
    $('.modal').show();
});
$('.close-modal').on('click', function () {
    $('.modal').hide();
})
$('.close-flash').on('click', function () {
    $('.alert').slideUp(400);
});

setTimeout(function () {
    $('.alert').slideUp(400);
}, 5000);

$('.quantity').on('input', function () {
    $(this).parent().next().children().last().html($(this).val() * $(this).parent().next().children().first().html());
    let cartTotalDynamic = 0;
    $('.cart-item-sum').each(function () {
        cartTotalDynamic += Number($(this).html());
    })
    $('.cart-sum').html(cartTotalDynamic);
});
let cartTotal = 0;
$('.cart-item-sum').each(function () {
    cartTotal += Number($(this).html());
})
$('.cart-sum').html(cartTotal);

$('#cartItemQuantity').on('change', function () {
    const id = $(this).prev().val();

    $.ajax({
        url: `/cart/update/${id}`,
        type: 'POST',
        data: $(this).val(),
        contentType: 'application/json',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
    }).done(res => {
        console.log(res);
    });
});



