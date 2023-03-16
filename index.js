let more = document.getElementsByName('more');
more.forEach(
    function (el) {

        el.onclick = function (event) {
            event.preventDefault();
            let pId = this.id;
            // SHOW PRODUCT IN MODAL 
            document.getElementById('popup-page').style.display = "block";
            // CLOSING MODAL 
            _('btn-popup-close').onclick = function () {
                _('popup-page').style.display = "none";

            }
            // END CLOSE MODAL 
            let pShow = _('popup-show');

            $.ajax({
                url: './control/action.php',
                method: 'POST',
                data:{
                    fetchSingleProduct: pId,
                },
                beforeSend: function () {
                    pShow.innerHTML = '<i class="fa fa-circle-o-notch fa-spin"></i>';
                },
                success: function(data){
                    pShow.innerHTML = data;
                }
            }).done(
                function () {
                    // HANDLING, CHECKOUT, ADD TO CART AND LIKE 
                    let btnCheckOut = document.getElementsByName("btn-checkout");
                    let btnAddToCart = document.getElementsByName("btn-add-to-cart");
                    // console.log(btnCheckOut);
                    // CHECKOUT FUNCTION HANDLER
                    btnCheckOut.forEach(
                        function (element) {
                            element.onclick = function (event) {
                                event.preventDefault();
                                let id = this.id;
                            //    REPLACE THE MAIN CONTAINER WITH THIS PRODUCT CHECK OUT PAGE 
                               
                                $.ajax({
                                    url: './control/action.php',
                                    method: 'POST',
                                    data:{
                                        singleCheckOut: id
                                    },
                                    beforeSend: function () {
                                        _('cart').innerHTML = '<div class="text-center "> <i class="fa fa-spinner fa-spin" id="large"></i></div>';
                                        _('popup-page').style.display = "none";
                                        this.disabled = true;
                                    },
                                    success: function (data) {
                                        if (data.trim() === 'You are not login') {
                                            window.location = './login.php?cart'
                                        }else{
                                            _('cart').innerHTML = data;
                                            let qty = _('qty');
                                            let price = _('price');
                                            let total = _('total');
                                            total.value = `N ${Number(qty.value)*Number(price.value)}`;
                                            
                                            
                                        }
                                        
                                    }
                                    
                                }).done(
                                    function () {
                                        qty.onkeyup = function(){
                                            console.log(this.value)
                                            if (Math.sign(this.value) ==="-") {
                                                this.value = "1"
                                                total.value = `N ${Number(qty.value)*Number(price.value)}`;
                                            }else if(this.value === "0"){
                                                this.value = 1
                                                total.value = `N ${Number(qty.value)*Number(price.value)}`;
                                            }else{
                                                this.value = this.value
                                                total.value = `N ${Number(qty.value)*Number(price.value)}`;
                                            }
                                        }
                                        qty.onmouseup = function(){
                                            console.log(this.value)
                                            if (Math.sign(this.value) ==="-") {
                                                this.value = "1"
                                                total.value = `N ${Number(qty.value)*Number(price.value)}`;
                                            }else{
                                                this.value = this.value
                                                total.value = `N ${Number(qty.value)*Number(price.value)}`;
                                            }
                                        }
                                        qty.onblur = function () {
                                            console.log(this.value)
                                            if (this.value === "" || this.value === "0") {
                                                this.value = 1;

                                                this.value = this.value
                                                total.value = `N ${Number(qty.value)*Number(price.value)}`;

                                            }
                                        }
                                    }
                                )
                            }
                        }
                    );

                    btnAddToCart.forEach(
                        function (element) {
                            element.onclick = function () {
                                let id = this.id;
                                _('cart').innerHTML = id;
                                _('popup-page').style.display = "none";

                                // SHOW THE CART PAGE WITH THIS PRODUCT ADDED 
                            }
                        }
                    );
                }
            )

        }
    }
)


// SHOWING CART NUMBER 
let cartLink = _('link-show-cart-number');

cartLink.onclick = function (event) {
    event.preventDefault();
    _('cart').innerHTML = '<div class="text-center "> <i class="fa fa-spinner fa-spin" id="large"></i></div>';

    $.ajax({
        url: './control/action.php', 
        method: 'POST',
        data:{
            showCart: '1'
        }, 
        beforeSend: function () {
            
        }, 
        success: function (data) {
            _('cart').innerHTML = data;
        }
    })
}