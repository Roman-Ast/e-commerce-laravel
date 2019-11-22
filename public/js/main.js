$(function() {
        
    $('.list-group-item').on('click', function() {
      $('.glyphicon', this)
        .toggleClass('glyphicon-chevron-right')
        .toggleClass('glyphicon-chevron-down');
    });
  
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


$('.useFilter').on('click',function (e) {
    e.preventDefault();

    const reqObject = {
        
    }
    console.log($('#priceValue').val());
    $('#accordion input[type=checkbox]').each(function() {
        if ($(this).is(":checked")) {
            console.log($(this).attr('name'));
        }
     });
    
});