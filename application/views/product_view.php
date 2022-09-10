<!DOCTYPE html>
<html>
<head>
	<title>Shopping cart using codeigniter and AJAX</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
</head>
<body>
<div class="container">
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
			<i class="fa-solid fa-cart-shopping"></i>
			&nbsp; <span class="bg-primary text-white px-2 py-1" style="border-radius: 50%;" id="cart_count"></span>
		</a>
        </li>
      
    </div>
  </div>
</nav>
	<h2 class="mt-2">Shopping Cart Using Ajax and Codeigniter</h2>
	<hr/>
	<div class="row">
		<div class="col-md-8">
			<h4>Product</h4>
			<div class="row">
			<?php foreach ($data->result() as $row) : ?>
				<div class="col-md-4">
					<div class="thumbnail">
						<img width="200" src="<?php echo base_url().'assets/images/'.$row->product_image;?>">
						<div class="caption">
							<h4><?php echo $row->product_name;?></h4>
							<div class="row">
								<div class="col-md-7">
									<h4><?php echo number_format($row->product_price);?></h4>
								</div>
								<div class="col-md-5">
									<input type="number" name="quantity" id="<?php echo $row->product_id;?>" value="1" class="quantity form-control">
								</div>
							</div>
							<button class="add_cart btn btn-success btn-block" data-productid="<?php echo $row->product_id;?>" data-productname="<?php echo $row->product_name;?>" data-productprice="<?php echo $row->product_price;?>">Add To Cart</button>
						</div>
					</div>
				</div>
			<?php endforeach;?>
				
			</div>

		</div>
		<div class="col-md-4">
			<h4>Shopping Cart</h4>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Items</th>
						<th>Price</th>
						<th>Qty</th>
						<th>Total</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody id="detail_cart">

				</tbody>
				
			</table>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.2.1.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.add_cart').click(function(){
			var product_id    = $(this).data("productid");
			var product_name  = $(this).data("productname");
			var product_price = $(this).data("productprice");
			var quantity   	  = $('#' + product_id).val();
			$.ajax({
				url : "<?php echo site_url('product/add_to_cart');?>",
				method : "POST",
				data : {product_id: product_id, product_name: product_name, product_price: product_price, quantity: quantity},
				success: function(data){
					$('#detail_cart').html(data);
				}
			});
		});

		
		$('#detail_cart').load("<?php echo site_url('product/load_cart');?>");

		
		$(document).on('click','.romove_cart',function(){
			var row_id=$(this).attr("id"); 
			$.ajax({
				url : "<?php echo site_url('product/delete_cart');?>",
				method : "POST",
				data : {row_id : row_id},
				success :function(data){
					$('#detail_cart').html(data);
				}
			});
		});
	});
</script>
</body>
</html>