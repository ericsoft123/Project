// JavaScript Document
//send data in database code
	$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

	$(document).ready(function(){
		"use strict";
		$('#update').click(function(e){
			var product_name=$('#product_name').val();
			var quantity=$('#quantity').val();
			var price=$('#price').val();
			var id=$('#id').val();
			$.ajax({
				url:"./update",
				method:"post",
				//data:$("#formadd_data").serialize(),
				data:{id:id,product_name:product_name,quantity:quantity,price:price},
				success:function()
				{
					alert('data has been saved');
			gettable();
			getsum();
				}
				
			});
			e.preventDefault();
		});
	});
$(document).ready(function(){
		"use strict";
		$('#send').click(function(e){
			var product_name=$('#product_name').val();
			var quantity=$('#quantity').val();
			var price=$('#price').val();
			$.ajax({
				url:"./create",
				method:"post",
				//data:$("#formadd_data").serialize(),
				data:{product_name:product_name,quantity:quantity,price:price},
				success:function()
				{
					alert('product has been saved');
				gettable();
			getsum();
					
				}
				
			});
			e.preventDefault();
		});
	});
function delete_funct(id)
{
	"use strict";
	$.ajax({
		url:"./delete",
		method:"post",
		data:{id:id},
		success:function(){
			gettable();
			getsum();
		}
		
	});
	return false;
}
function edit_funct(id,product_name,price,quantity)
{
	"use strict";
$('#update').show();
	$('#iddata').show();
	$('#send').hide();
	$('#id').val(id);
	$('#product_name').val(product_name);
	$('#price').val(price);
	$('#quantity').val(quantity);
}
function getsum()
{
	"use strict";
	$.ajax({
		url:"./sum",
		method:"get",
		success:function(data){
			$('#totalall').text(data);
		}
	});
}
function gettable()
{
		$.ajax({
		url:"./gettable",
		method:"get",
		
		success:function(data){
			console.log('deleted');
						var n=1;
					var getproductdata=data.getdata;
					//$('#tabledata').html();
						var product_data=`<table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                
                <th>product_name</th>
                
                <th>Quantity in stock</th>
                <th>price per Item</th>
                <th>Datetime submitted</th>
                
                <th>Total value number</th>
                
                <th>Action</th>
                
            </tr>
        </thead>`;
		for(var i=0;i<getproductdata.length;i++)
			{
				product_data+=` <tbody>
        <tr>
                <th scope="row">${n}</th>
                
                
                <td>${getproductdata[i].product_name}</td>
              
                <td>${getproductdata[i].quantity}</td>
                <td>${getproductdata[i].price}</td>
<td>${getproductdata[i].created_at}</td>
              
                <td>${getproductdata[i].total}</td>
                
                <td>
                <a class="btn btn-danger" href="#" id="views"

onclick="return delete_funct('${getproductdata[i].id}')">Delete</a>   <a class="btn btn-danger" href="#" id="views"

onclick="return edit_funct('${getproductdata[i].id}','${getproductdata[i].product_name}','${getproductdata[i].quantity}','${getproductdata[i].price}')">Edit</a>
                </td>
                
            </tr>
        
        
       </tbody>
       
        `;
				n++;
			}
		product_data+='</table>';
			$('#tabledata').html(product_data);
				
		}
		
	});
}
$(document).ready(function(){
		"use strict";
	$('#update').hide();
	$('#iddata').hide();
	gettable();
	getsum();
});
