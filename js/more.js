let btnCheckOut = document.getElementsByName("btn-checkout");
let btnAddToCart = document.getElementsByName("btn-add-to-cart");
// console.log(btnCheckOut);
// CHECKOUT FUNCTION HANDLER
btnCheckOut.forEach(function (element) {
  element.onclick = function (event) {
    event.preventDefault();
    let id = this.id;
    //    REPLACE THE MAIN CONTAINER WITH THIS PRODUCT CHECK OUT PAGE

    $.ajax({
      url: "./control/action.php",
      method: "POST",
      data: {
        singleCheckOut: id,
      },
      beforeSend: function () {
        _("cart").innerHTML =
          '<div class="text-center "> <i class="fa fa-spinner fa-spin" id="large"></i></div>';
        _("popup-page").style.display = "none";
        this.disabled = true;
      },
      success: function (data) {
        if (data.trim() === "You are not login") {
          window.location = "./login.php?cart";
        } else {
          _("cart").innerHTML = data;
          let qty = _("qty");
          let price = _("price");
          let total = _("total");
          total.value = `N ${Number(qty.value) * Number(price.value)}`;
        }
      },
    }).done(function () {
      let qty = _("qty");
      let price = _("price");
      let total = _("total");
      total.value = `N ${Number(qty.value) * Number(price.value)}`;
      qty.onkeyup = function () {
        console.log(this.value);
        if (Math.sign(this.value) === "-") {
          this.value = "1";
          total.value = `N ${Number(qty.value) * Number(price.value)}`;
        } else if (this.value === "0") {
          this.value = 1;
          total.value = `N ${Number(qty.value) * Number(price.value)}`;
        } else {
          this.value = this.value;
          total.value = `N ${Number(qty.value) * Number(price.value)}`;
        }
      };
      qty.onmouseup = function () {
        console.log(this.value);
        if (Math.sign(this.value) === "-") {
          this.value = "1";
          total.value = `N ${Number(qty.value) * Number(price.value)}`;
        } else {
          this.value = this.value;
          total.value = `N ${Number(qty.value) * Number(price.value)}`;
        }
      };
      qty.onblur = function () {
        console.log(this.value);
        if (this.value === "" || this.value === "0") {
          this.value = 1;

          this.value = this.value;
          total.value = `N ${Number(qty.value) * Number(price.value)}`;
        }
      };
    });
  };
});

btnAddToCart.forEach(function (element) {
  element.onclick = function () {
    let id = this.id;
    _("cart").innerHTML = id;
    _("popup-page").style.display = "none";

    // SHOW THE CART PAGE WITH THIS PRODUCT ADDED
  };
});

// add vueconst { createApp } = Vue;
const { createApp } = Vue;

createApp({
  data() {
    return {
      bid_amount: 0,
      start_amount: 0,
      show_status: "",
      show_loader: false,
      isBidded: false,

      bid_object: {
        amount: 0,
      },
    };
  },

  methods: {
    submitBid() {
      const start_amount = Number(
        this.$refs.start_amount.value.replace(",", "")
      );

      const product_id = this.$refs.product_id.value;

      //   check bid amount if its less
      if (this.bid_amount > start_amount) {
        this.show_status = "";
        this.show_loader = true;

        axios
          .post("./control/action.php", {
            submit_bid: true,
            product_id: product_id,
            amount_bid: this.bid_amount,
          })
          .then((res) => {
            if (res.data.status) {
              this.show_status = this.print_success(res.data.message);

              this.isBidded = true;
              this.isBidded = true;
              this.checkBid();
            } else {
              this.show_status = this.print_error(res.data.message);
            }
          })
          .catch((err) => {
            console.log(err);
          });

        // disabled the button, show loader, and send request
      } else {
        this.show_status = this.print_error(
          "Your bid amount is less than minimum bid"
        );
      }
    },

    checkBid() {
      const product_id = this.$refs.product_id.value;
      axios
        .post("./control/action.php", {
          checkBid: true,
          product_id: product_id,
        })
        .then((res) => {
          if (res.data.status) {
            this.isBidded = true;
            this.bid_object.amount = res.data.user.amount;
          }
        });
    },

    print_error(x) {
      return `<span class='text-danger'>${x}</span>`;
    },

    print_success(x) {
      return `<span class='text-success'>${x}</span>`;
    },
  },

  mounted() {
    this.bid_amount = this.$refs.start_amount.value.replace(",", "");
    this.checkBid();
  },
}).mount("#wrapper");
