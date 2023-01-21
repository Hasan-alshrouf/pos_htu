

const link = window.location.href;

const active = document.querySelectorAll("ul li a").forEach((item) => {

    if (link.indexOf(item.href) > -1) {
        item.classList.add("activee");
    }
});



////////////////////close popup no create/////////////////////
$(".ok").click(function () {
    $(".popup-no-create").fadeOut('1000');
});



////////////////////////////////Edit-Profile//////////////////////////////////////////////////
$(".Edit-Profile").click(function () {
    $("#template").hide(1000);
    $(".profile").removeClass('d-none');
});



//////////////////////////progress-bar //////////////////////////


$('.progress-quantity').each(function () {

    var number = $(this).attr('data-progress');


    $(this).animate({



        width: parseInt(number) + '%'


    }, 1500);
})

$('.progress-total').each(function () {

    var total = $(this).attr('data-progress') / 100;


    $(this).animate({



        width: parseInt(total) + '%'


    }, 1500);
})





//////////////////// clock/////////////////////////////////////

$(document).ready(function () {
    $("#navbar-side").fadeIn(0);
    clockUpdate();
    setInterval(clockUpdate, 1000);

})

function clockUpdate() {
    var date = new Date();

    $('.digital-clock').css({ 'color': '#fff' });
    function addZero(x) {
        if (x < 10) {
            return x = '0' + x;
        } else {
            return x;
        }
    }

    function twelveHour(x) {
        if (x > 12) {
            return x = x - 12;
        } else if (x == 0) {
            return x = 12;
        } else {
            return x;
        }
    }

    var h = addZero(twelveHour(date.getHours()));
    var m = addZero(date.getMinutes());


    $('.digital-clock').text(h + ':' + m)
}



//////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////API///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////




$.ajax({
    type: "GET",
    url: "http://pos_htu.local/sales_api/quntity_item",
    success: function (response) {

        var xValues = [];
        var yValues = [];
        var barColors = [];
        var tot = 0;
        response.body.forEach(item => {
            xValues.push(item.name);
            yValues.push(item.total_quntity);
            barColors.push("#" + Math.floor(Math.random() * 16777515).toString(16));
            tot += item.total_quntity;

        });


        new Chart("myChart", {

            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues


                }]
            },

            options: {
                title: {

                    display: true,
                    text: 'Total sold items ' + tot,



                }
            }


        });



    }

});


///////////////////////append item name from table items/////////////////////////////////
var num = 1;
$.ajax({
    type: "GET",
    url: "http://pos_htu.local/sales_api",
    success: function (response) {


        response.body.forEach(item => {

            $('#items').append(`
           <option  value=${item.id} > ${item.name} </option>
           `);


        });
    }

});


////////////////////////When I change value quantity in the selected item  ////////////////////////////////


$("#items").change(function () {
    // git items_id selected
    items_id = $(this).children(":selected").attr("value")

    $.ajax({
        type: "POST",
        url: "http://pos_htu.local/sales_api/quantity",
        data: JSON.stringify({
            id: items_id

        }),

        success: function (response) {

            response.body.forEach(item => {

                $('#quantity').attr({
                    "max": item.quantity,


                });
                quantity = $('#quantity').val(),
                    $('#price').attr({

                        "value": item.selling_price * quantity,


                    });

                $('#quantity').change(function () {
                    quantity = $('#quantity').val(),
                        $('#price').attr({
                            "value": item.selling_price * quantity,

                        });
                });
            });


        }
    });

});




///////////////////////append new transaction when pressing the add /////////////////////////////////

$(function () {
    const items = $('#items');
    const itemQuantity = $('#quantity');
    const itemPrice = $('#price');
    const add = $('#add');
    const table = $('#table-transaction');



    add.click(function (e) {

        e.preventDefault();

        let item = items.children("option:selected").text();
        let x = $("input").attr("max");

        let data = {

            item_id: items.val(),
            total: itemPrice.val(),
            quntity_item: itemQuantity.val(),
        }



        if (itemQuantity.val() != 0) {

            if (x >= itemQuantity.val()) {

                $(".popup").fadeIn('slow');
                $(".popup").animate({ height: '270px' })
                $(".popup").fadeOut('slow');

                $.ajax({
                    type: "post",
                    url: "http://pos_htu.local/sales_api/create_transaction",
                    data: JSON.stringify(data),


                    success: function (response) {
                        $('#total-sales').text(parseInt(response.total_sales) + parseInt(data['total']));


                        table.append(`
            <tr>
                <td>${num}</td>
                <td>${item}</td>
                <td>${data['quntity_item']}</td>
                <td>${data['total']} $</td>
             
                <td>
                <a href="/sales/edit?id=${response.body}" class="btn btn-secondary" > 
                Edit </a>
                <a href="/sales?id_delete=${response.body}" class="btn btn-danger" id="${response.body}">
                Delete</i>
               </a>
               </td>
            </tr>
           `);
                        num++;
                    }
                });
            } else {

                $(".popup-no").fadeIn('1000');
                $(".popup-no").animate({ height: '265px' })
                $(".ok").click(function () {
                    $(".popup-no").fadeOut('slow');
                });


            }

        } else if (x == 0) {
            $(".popup-out-of-stock").fadeIn('1000');
            $(".popup-out-of-stock").animate({ height: '265px' })
            $(".ok").click(function () {
                $(".popup-out-of-stock").fadeOut('slow');
            });


        } else {
            $(".popup-empty").fadeIn('1000');
            $(".popup-empty").animate({ height: '265px' })
            $(".ok").click(function () {
                $(".popup-empty").fadeOut('slow');
            });
        }









    });
});




let totalSales = 0;
/////////////////////get_transactions_by_logged_in_user////////////////////////////////

$.ajax({
    type: "GET",
    url: "http://pos_htu.local/sales_api/git_transaction",
    success: function (response) {
        $('#total-sales').text(response.total_sales);
        response.body.forEach(item => {

            $('#table-transaction').append(`
           <tr>
            
           <td>${num}</td>
            <td>${item.name}</td>
            <td>${item.quntity_item}</td>
            <td>${item.total} $</td>
            
            <td>
            
          
            <a href="/sales/edit?id=${item.transactions_id}" class=" btn btn-secondary"> 
            Edit </a>
            <a href="/sales?id_delete=${item.transactions_id}" class="delete btn btn-danger" id="${item.transactions_id}">
            Delete</i>
           </a>
           
           </td>
           </tr>
       `);
            num++;
        });

    }
});




/////////////////////////////when click edit Display the edit page for the selected item////////////////////////////////////////


// get id in URLSearchParams
let searchParams = new URLSearchParams(window.location.search)
let id_transaction = searchParams.get('id')

if (id_transaction != null) {
    $.ajax({


        type: "POST",
        url: "http://pos_htu.local/sales_api/edit_transaction",
        data: JSON.stringify({
            id: id_transaction

        }),
        success: function (response) {

            response.body.forEach(item => {


                $('#idItem').attr({

                    "value": item.id,


                });
                $('#updateItem').attr({

                    "value": item.name,


                });

                $('#updateQuantity').attr({

                    "data-database": item.quantity,
                    "value": item.quntity_item,
                    "data-old": item.quntity_item,
                    "max": parseInt(item.quantity) + parseInt(item.quntity_item),

                });

                $('#updatePrice').attr({

                    "value": item.total,
                });



                $('#updateQuantity').change(function () {
                    quantity = $('#updateQuantity').val(),
                        $('#updatePrice').attr({
                            "value": item.selling_price * quantity,
                        });

                });



            });


        }


    });
}


///////////////////////edit transaction when pressing the update /////////////////////////////////


$(function () {

    const id = $('#idItem');
    const item = $('#updateItem');
    const itemQuantity = $('#updateQuantity');
    const itemPrice = $('#updatePrice');
    const update = $('#update');
    const table = $('#table-transaction');



    update.click(function (e) {


        e.preventDefault();

        let quantityDatabase = $('#updateQuantity').attr("data-database");
        let quantityOld = $('#updateQuantity').attr("data-old");
        let quantityNew = itemQuantity.val();
        let itemName = item.val()

        let data = {
            // item_id: id.val(),
            id: id_transaction,
            total: itemPrice.val(),
            quntity_item: itemQuantity.val(),



        }
        if (itemQuantity.val() != 0) {

            if (parseInt(quantityDatabase) >= (parseInt(quantityNew) - parseInt(quantityOld))) {
                $(".popup").fadeIn('slow');
                $(".popup").animate({ height: '270px' })
                $(".popup").fadeOut('slow');

                setTimeout(function () {
                    window.location.href = "/sales"
                }, 1200);

                $.ajax({
                    type: "PUT",
                    url: "http://pos_htu.local/sales_api/save_update_transaction",

                    data: JSON.stringify(data),


                });



            } else {
                $(".popup-no").fadeIn('1000');

                $(".ok").click(function () {
                    $(".popup-no").fadeOut('slow');
                });


            }
        } else {
            $(".popup-empty").fadeIn('1000');
            $(".popup-empty").animate({ height: '265px' })
            $(".ok").click(function () {
                $(".popup-empty").fadeOut('slow');
            });
        }

    });

});



////////////////////////delete transaction///////////////////////////////////////////////

let id_delete = searchParams.get('id_delete')

if (id_delete != null) {

    $(".popup-accept-delete").fadeIn('1000');

    $(".yes").click(function () {
        $(".popup-accept-delete").fadeOut('slow');
        setTimeout(function () {
            window.location.href = "/sales"
        });

        $.ajax({

            type: "DELETE",
            url: "http://pos_htu.local/sales_api/delete_transaction",
            data: JSON.stringify({
                id: id_delete

            }),

        });


    });
    $(".no").click(function () {
        $(".popup-accept-delete").fadeOut('slow');
        setTimeout(function () {
            window.location.href = "/sales"
        });
    });




}
