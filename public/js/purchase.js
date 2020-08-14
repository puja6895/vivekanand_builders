$(document).ready(function () {

    var counter = 0;
    $("#js_error").text();
    $("#js_error_panel").hide();
    // var subTotal = 0;
    // var totalGst = 0;
    // var grandTotal = 0;

    $("#addrow").on("click", function () {

        $("#js_error_panel").hide();

        var available_stock = $('#available_stock').text();
        // if (available_stock > 0) {
        // if (parseInt(available_stock) >= $('#quantity0').val()) {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td style="width:15rem"><input class="form-control" readonly  value="' + $('#product_id0').children("option:selected").text() + '" type="text" name="product_name[]" required="" placeholder="Product"><input type="hidden" value="' + $('#product_id0').children("option:selected").val() + '" name="product_id[]" value=""></td>';

        cols += '<td style="width:8rem"><input readonly class="form-control" type="text" name="unit_name[]" placeholder="Unit" required value="' + $('#unit_id0').children("option:selected").text() + '"> <input type="hidden" name="unit_id[]" value="' + $('#unit_id0').children("option:selected").val() + '" ></td>';

        cols += '<td "><input readonly class="form-control" type="number" name="quantity[]" value="' + $('#quantity0').val() + '" required></td>';

        cols += '<td style="width:10rem"><div class="input-group"><span class="input-group-prepend"><label class="input-group-text"><span style="font-size: 17px;">&#8377;</span></label></span><input readonly type="text" class="form-control" name="rate[]" required value="' + $('#rate0').val() + '"></div></td>';

        cols += '<td ><div class="input-group"><input readonly type="text" class="form-control" name="gst[]" required value="' + $('#gst0').val() + '"><span class="input-group-prepend"><label class="input-group-text"><i class="fa fa-percent"></i></label></span></div></td>';

        cols += '<td style="width:10rem"><div class="input-group"><span class="input-group-prepend"><label class="input-group-text"><span style="font-size: 17px;">&#8377;</span></label></span><input readonly type="text" class="form-control" name="total[]" required value="' + $('#total0').val() + '"></div></td>';

        cols += '<td ><button type="button" data-toggle="tooltip" title="Delete Product" class="btn btn-sm btn-danger ibtnDel" ><i class="fa fa-trash"></i></button></td>';
        newRow.append(cols);
        $("#purchaseTable").append(newRow);
        counter++;

        // // Update Total 
        // subTotal = parseInt(subtotal) + (parseInt($("#rate0").val()) * parseInt($("#quantity0")));
        // $("#subTotal").text(subtotal);

        // totalGst = parseInt(totalGst)
        // $("#product_id0").val("0").change();
        // $("#product_id0").text("Product");
        $("#unit_id0").val("0").change();
        // $("#unit_id0").text('Unit');
        $('#rate0').val(0);
        $('#quantity0').val(1);
        $('#gst0').val(0);
        $('#total0').val(0);
        //     }else{
        //         $("#js_error").text('Quantity must be Less Than Or Equal To Available Stock '+available_stock+' .');
        //         $("#js_error_panel").show();
        //     }

        // }else{
        //     $("#js_error").text('Available Stock Must Be Greater Than 0.');
        //     $("#js_error_panel").show();
        // }

    });



    $("#purchaseTable").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();
        counter -= 1
    });


});

function setDefault() {

    $("#js_error").text();
    $("#js_error_panel").hide();

    var product_id = $('#product_id0').children("option:selected").val();
    var unit_id = $('#unit_id0').children("option:selected").val();
    $(".loading").show();

    $.ajax({
        type: "GET",
        url: '/default_product/' + product_id,
        dataType: 'json',
        success: function (response) {
            // console.log(response);
            $(".loading").hide();
            $("#unit_id0").val(response.unit_name).change();
            console.log(response.unit_name);
            // $("#unit_id0").attr('disabled', true);
            // $('#rate0').val(response.sell_price);
           
                $('#rate0').val(response.purchase_price);
                var total = (parseInt(response.purchase_price) * parseInt($('#quantity0').val()));

            
            // $('#gst0').val(response.gst ? response.gst : 0);
            // $('#quantity0').val(1);
            // $("#quantity0").attr({
            //     "max": parseInt(response.stock), // substitute your own
            //     "min": 1 // values (or variables) here
            // });
            // $('#available_stock').text(parseInt(response.stock));


            var final_total = total + ((total) * (parseInt($('#gst0').val()) / 100));
            $('#total0').val($.isNumeric(final_total) ? final_total : 0);


        }
    });
    // console.log(unit_id);
}

function calculateTotal() {
    
        var rate = $('#rate0').val();
   
    var gst = $('#gst0').val();
    var quant = $('#quantity0').val();
    var total = (parseInt(rate) + ((parseInt(gst) / 100) * parseInt(rate))) * parseInt(quant);
    $('#total0').val($.isNumeric(total) ? total : 0);
}

function calculateRow(row) {
    var price = +row.find('input[name^="price"]').val();

}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="price"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
}