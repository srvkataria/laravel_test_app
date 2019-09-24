<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Bootstrap core CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
        <!-- Bootstrap core JavaScript-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

        <!-- Core plugin JavaScript-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.compatibility.js" integrity="sha256-MWsk0Zyox/iszpRSQk5a2iPLeWw0McNkGUAsHOyc/gE=" crossorigin="anonymous"></script>



        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: flex-start;
                flex-direction: column;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

    </head>
    <body>
        <div id="main_page" class="flex-center position-ref full-height">
            <div style="margin-top: 100px; display: flex; flex-direction: row;">
                <div style="width: 200px;">
                    <h4><b>Product Name: </b></h4>
                </div>
                <div style="padding-left: 50px;">
                    <input type="text" class="input_product_name"/>
                </div>
            </div>
            <div style="margin-top: 10px; display: flex; flex-direction: row;">
                <div style="width: 200px;">
                    <h4><b>Qty in Stock: </b></h4>
                </div>
                <div style="padding-left: 50px;">
                    <input type="text" class="input_qty"/>
                </div>
            </div>
            <div style="margin-top: 10px; display: flex; flex-direction: row;">
                <div style="width: 200px;">
                    <h4><b>Price per item: </b></h4>
                </div>
                <div style="padding-left: 50px;">
                    <input type="text" class="input_price"/>
                </div>
            </div>
            <div style="margin-top: 30px;">
                <button type="submit" class="btn save_btn btn-sm" value="Save" ><span style="font-size: 18px;"><b>Save</b></span></button>
            </div>
            <div class="table-responsive" style="margin-top: 40px;">
              <table id="table_records" class="table" align="center" style="width: 70%;">
                
              </table>
            </div>
        </div>
    </body>
    <script>
        $.ajax({
            url: "ajaxCall",
            type: "GET",
            data: {
                action: 'get_all_records',
            },
            success: function(result) {
                //alert(result);
                var table_data_raw = JSON.parse(result);
                //alert(table_data_raw.length);
                var html_content = '';
                var sum_value = 0;
                    if ( table_data_raw.length > 0 ) {
                        html_content = html_content+'<tr><th>Product Name</th><th>Qty</th><th>Price (Per Item)</th><th>Datetime Submitted</th><th>Total value</th><th>Action</th></tr>';
                    }
                    for (var i=0; i<table_data_raw.length; i++) {
                        html_content = html_content+'<tr data-row-id="'+i+'">';
                        html_content = html_content+'<td>'+table_data_raw[i]['product_name']+'</td>';
                        html_content = html_content+'<td>'+table_data_raw[i]['qty']+'</td>';
                        html_content = html_content+'<td>'+table_data_raw[i]['price']+'</td>';
                        html_content = html_content+'<td>'+table_data_raw[i]['created_at']+'</td>';
                        html_content = html_content+'<td>'+table_data_raw[i]['total_value']+'</td>';
                        sum_value = sum_value + parseFloat(table_data_raw[i]['total_value']);
                        html_content = html_content+'<td><button type="submit" class="btn edit_btn btn-sm" value="Edit" ><span style="font-size: 14px;"><b>Edit</b></span></button>&nbsp;<button type="submit" class="btn del_btn btn-sm" value="Delete" ><span style="font-size: 14px;"><b>Delete</b></span></button></td>';
                        
                        html_content = html_content+'</tr>';
                    }
                    if ( table_data_raw.length > 0 ) {
                        html_content = html_content+'<tr><td></td><td></td><td></td><td></td><td><b>'+sum_value+'</b></td></tr>';
                    }
                    $("#table_records").html(html_content);
                /*for(var key in table_data_raw[i]) {
                alert(key+"::::"+sales_data_raw.sales[i][key]);
                    //table_row_data.push({'value': sales_data_raw.sales[i][key]});
                }*/
                
            }
        });

        $("#main_page").on('click', '.save_btn', function() {
            var product_name = $('.input_product_name').val();
            var qty = $('.input_qty').val();
            var price = $('.input_price').val();

            var input_data = {'product_name': product_name,'qty': qty,'price':price};
            $.ajax({
                url: "ajaxCall",
                type: "GET",
                data: {
                    action: 'save_record',
                    input_data: JSON.stringify(input_data),
                },
                success: function(result) {
                    //alert(result);
                    var table_data_raw = JSON.parse(result);
                    //alert(table_data_raw.length);
                    var html_content = '';
                    var sum_value = 0;
                    if ( table_data_raw.length > 0 ) {
                        html_content = html_content+'<tr><th>Product Name</th><th>Qty</th><th>Price (Per Item)</th><th>Datetime Submitted</th><th>Total value</th><th>Action</th></tr>';
                    }
                    for (var i=0; i<table_data_raw.length; i++) {
                        html_content = html_content+'<tr data-row-id="'+i+'">';
                        html_content = html_content+'<td>'+table_data_raw[i]['product_name']+'</td>';
                        html_content = html_content+'<td>'+table_data_raw[i]['qty']+'</td>';
                        html_content = html_content+'<td>'+table_data_raw[i]['price']+'</td>';
                        html_content = html_content+'<td>'+table_data_raw[i]['created_at']+'</td>';
                        html_content = html_content+'<td>'+table_data_raw[i]['total_value']+'</td>';
                        sum_value = sum_value + parseFloat(table_data_raw[i]['total_value']);
                        html_content = html_content+'<td><button type="submit" class="btn edit_btn btn-sm" value="Edit" ><span style="font-size: 14px;"><b>Edit</b></span></button>&nbsp;<button type="submit" class="btn del_btn btn-sm" value="Delete" ><span style="font-size: 14px;"><b>Delete</b></span></button></td>';
                        
                        html_content = html_content+'</tr>';
                    }
                    if ( table_data_raw.length > 0 ) {
                        html_content = html_content+'<tr><td></td><td></td><td></td><td></td><td><b>'+sum_value+'</b></td></tr>';
                    }
                    $("#table_records").html(html_content);
                    /*for(var key in table_data_raw[i]) {
                    alert(key+"::::"+sales_data_raw.sales[i][key]);
                        //table_row_data.push({'value': sales_data_raw.sales[i][key]});
                    }*/
                    
                }
            });
        });

        $("#main_page").on('click', '.del_btn', function() {
            //alert($(this).closest('tr').attr('data-row-id'));
            var row_id = $(this).closest('tr').attr('data-row-id');

            //alert(row_id)
            $.ajax({
                url: "ajaxCall",
                type: "GET",
                data: {
                    action: 'delete_record',
                    row_id: row_id,
                },
                success: function(result) {

                    //alert(result);
                    var table_data_raw = JSON.parse(result);
                    //alert(table_data_raw.length);
                    var html_content = '';
                    var sum_value = 0;
                    if ( table_data_raw.length > 0 ) {
                        html_content = html_content+'<tr><th>Product Name</th><th>Qty</th><th>Price (Per Item)</th><th>Datetime Submitted</th><th>Total value</th><th>Action</th></tr>';
                    }
                    for (var i=0; i<table_data_raw.length; i++) {
                        html_content = html_content+'<tr data-row-id="'+i+'">';
                        html_content = html_content+'<td>'+table_data_raw[i]['product_name']+'</td>';
                        html_content = html_content+'<td>'+table_data_raw[i]['qty']+'</td>';
                        html_content = html_content+'<td>'+table_data_raw[i]['price']+'</td>';
                        html_content = html_content+'<td>'+table_data_raw[i]['created_at']+'</td>';
                        html_content = html_content+'<td>'+table_data_raw[i]['total_value']+'</td>';
                        sum_value = sum_value + parseFloat(table_data_raw[i]['total_value']);
                        html_content = html_content+'<td><button type="submit" class="btn edit_btn btn-sm" value="Edit" ><span style="font-size: 14px;"><b>Edit</b></span></button>&nbsp;<button type="submit" class="btn del_btn btn-sm" value="Delete" ><span style="font-size: 14px;"><b>Delete</b></span></button></td>';
                        
                        html_content = html_content+'</tr>';
                    }
                    if ( table_data_raw.length > 0 ) {
                        html_content = html_content+'<tr><td></td><td></td><td></td><td></td><td><b>'+sum_value+'</b></td></tr>';
                    }
                    $("#table_records").html(html_content);
                    
                }
            });
        });

        $("#main_page").on('click', '.edit_btn', function() {
            //alert($(this).closest('tr').attr('data-row-id'));
            var row_id = $(this).closest('tr').attr('data-row-id');
            $("#table_records").find('button').attr('disabled','disabled');
            $(this).closest('tr').after('<tr class="row-edit" data-row-id="'+row_id+'"><td align="center" colspan=2 style="border:0px"><input type="text" class="edit_product_name" placeholder="Product Name">&nbsp;<input type="text" class="edit_qty" placeholder="Qty">&nbsp;<input type="text" class="edit_price" placeholder="Price (Per Item)">&nbsp;<button type="submit" class="btn edit_record_btn btn-sm" value="Save" ><span style="font-size: 13px;"><b>Save</b></span></button>&nbsp;<button type="submit" class="btn cancel_btn btn-sm" value="Cancel" ><span style="font-size: 13px;"><b>Cancel</b></span></button></td></tr>');

            
        });

        $("#main_page").on('click', '.cancel_btn', function() {
            //alert($(this).closest('tr').parent().html());
            $(this).closest('tr').html('');
            $("#table_records").find('button').removeAttr('disabled');
        });

        $("#main_page").on('click', '.edit_record_btn', function() {
            var row_id = $(this).closest('tr').attr('data-row-id');
            var product_name = $(this).closest('tr').find('.edit_product_name').val();
            var qty = $(this).closest('tr').find('.edit_qty').val();
            var price = $(this).closest('tr').find('.edit_price').val();

            $.ajax({
                url: "ajaxCall",
                type: "GET",
                data: {
                    action: 'edit_record',
                    row_id: row_id,
                    product_name: product_name,
                    qty: qty,
                    price: price,
                },
                success: function(result) {

                    //alert(result);
                    var table_data_raw = JSON.parse(result);
                    var html_content = '';
                    var sum_value = 0;
                    if ( table_data_raw.length > 0 ) {
                        html_content = html_content+'<tr><th>Product Name</th><th>Qty</th><th>Price (Per Item)</th><th>Datetime Submitted</th><th>Total value</th><th>Action</th></tr>';
                    }
                    for (var i=0; i<table_data_raw.length; i++) {
                        html_content = html_content+'<tr data-row-id="'+i+'">';
                        html_content = html_content+'<td>'+table_data_raw[i]['product_name']+'</td>';
                        html_content = html_content+'<td>'+table_data_raw[i]['qty']+'</td>';
                        html_content = html_content+'<td>'+table_data_raw[i]['price']+'</td>';
                        html_content = html_content+'<td>'+table_data_raw[i]['created_at']+'</td>';
                        html_content = html_content+'<td>'+table_data_raw[i]['total_value']+'</td>';
                        sum_value = sum_value + parseFloat(table_data_raw[i]['total_value']);
                        html_content = html_content+'<td><button type="submit" class="btn edit_btn btn-sm" value="Edit" ><span style="font-size: 14px;"><b>Edit</b></span></button>&nbsp;<button type="submit" class="btn del_btn btn-sm" value="Delete" ><span style="font-size: 14px;"><b>Delete</b></span></button></td>';
                        
                        html_content = html_content+'</tr>';
                    }
                    if ( table_data_raw.length > 0 ) {
                        html_content = html_content+'<tr><td></td><td></td><td></td><td></td><td><b>'+sum_value+'</b></td></tr>';
                    }
                    $("#table_records").html(html_content);
                    
                }
            });
        });
        
    </script>
</html>
