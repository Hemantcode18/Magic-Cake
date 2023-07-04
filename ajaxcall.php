<script src="js/jquery-3.3.1.min.js"></script>
<script>

  
       

    function addtowishlist(id) {

        $.ajax({
            type: "POST",
            url: "wishlistproduct.php",
            data: {
                p_id: id,
            },
            success: function(data) {
                // alert(data);
                if (data == 0) {
                    swal("oops !", "product already added to wishlist", "info");
                } else if (data == 1) {
                    swal("Good Job !", "Product successfully added to wishlist", "success");
                }
                wishlistcount();
            }
        });
    }

    function wishlistcount() {
        $.ajax({
            type: "POST",
            url: "wishlistcount.php",

            success: function(data3) {
                $('#wishlistcount').html(data3);
                $('#wishlistcount1').html(data3);
            }
        });
    }

    function addtocart(id) {
        qty = 1;
        $.ajax({
            type: "POST",
            url: "addcartproduct.php",
            data: {
                p_id: id,
                qty: qty,
            },
            success: function(data) {
                // alert(data);
                if (data == 0) {
                    swal("oops !", "product already added to cart", "info");
                } else if (data == 1) {
                    swal("Good Job !", "Product successfully added to cart", "success");
                }
                cartcount();
                subtotal();

            }
        });
    }

    function subtotal() {
        $.ajax({
            type: "POST",
            url: "cartsubtotal.php",

            success: function(data2) {

                $("#subtotal").html(data2);
                $("#subtotal2").html(data2);
                $("#subtotal3").html(data2);
                $("#subtotal4").html(data2);

            }
        });



    }
    function cartcount() {

$.ajax({
    type: "POST",
    url: 'cartcount.php',

    success: function(data2) {

        $('#count3').html(data2);
        $('#count4').html(data2);

    }
});
}


   
</script>