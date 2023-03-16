// add vueconst { createApp } = Vue;
import { createApp } from "vue";

createApp({
  data() {
    return {
      bids: [],
      currentBid: [],
      show_popup: false,
      no_bid: false,
      show_bid_status: "",
      currentBidWon: false,
      proposedBid: [],
      currentPaymentBid: {},
      toogleProposed: true,
    };
  },

  methods: {
    getMyBids() {
      axios
        .post("./control/action.php", {
          getMyBids: true,
        })
        .then((res) => {
          this.bids = res.data.data;
        });
    },

    getBid(id) {
      axios
        .post("./control/action.php", {
          getBidById: true,
          product_id: id,
        })
        .then((res) => {
          if (res.status) {
            if (res.data.data && res.data.data.length > 0) {
              this.currentBid = res.data.data;
              this.no_bid = false;
            } else {
              this.no_bid = true;
            }
          } else {
            this.no_bid = true;
          }
        });
    },

    viewBids(product_id) {
      this.show_bid_status = "";
      this.currentBid = [];
      //  show modals
      this.checkBidWin(product_id);
      this.toggle_popup();
      this.getBid(product_id);
    },

    checkBidWin(product_id) {
      axios
        .post("./control/action.php", {
          checkBidWin: true,
          product_id: product_id,
        })
        .then((res) => {
          if (res.data.status) {
            this.currentBidWon = res.data.isWon;

            if (this.currentBidWon) {
              this.getBid(product_id);
            }
          } else {
            console.log("something went wrong");
          }
        });
    },

    selectBidWinner(product_id, user_id) {
      console.log(product_id, user_id);
      axios
        .post("./control/action.php", {
          selectedBidWinner: true,
          product_id: product_id,
          user_id: user_id,
        })
        .then((res) => {
          if (res.data.status) {
            this.show_bid_status = this.print_success(res.data.message);
            this.checkBidWin(product_id);
          } else {
            this.checkBidWin(product_id);

            this.show_bid_status = this.print_error("Something went wrong");
          }
        });
    },

    proposedBids() {
      this.toogleProposed = false;

      axios
        .post("./control/action.php", {
          proposedBids: true,
        })
        .then((res) => {
          if (res.data.status) {
            if (res.data.data && res.data.data.length > 0) {
              this.proposedBid = res.data.data;
            } else {
              this.show_bid_status = "You have not proposed on any bids";
            }
          } else {
            this.show_bid_status = "Something went wrong";
          }
        });
    },

    toggle_popup() {
      this.$refs.popup.classList.toggle("display-popup");
    },

    getBidByBidId(bid_id) {
      axios
        .post("./control/action.php", {
          getBidByBidId: true,
          bid_id: bid_id,
        })
        .then((res) => {
          console.log(res);
          if (res.status) {
            if (res.data.data && res.data.data.length > 0) {
              this.currentPaymentBid = res.data.data[0];

              FlutterwaveCheckout({
                public_key: "",
                tx_ref:
                  this.currentPaymentBid.product_name +
                  this.currentPaymentBid.user_id,
                amount: this.currentPaymentBid.amount,
                currency: "NGN",
                payment_options: "card, banktransfer, ussd",
                redirect_url:
                  "https://glaciers.titanic.com/handle-flutterwave-payment",
                meta: {
                  consumer_id: this.currentPaymentBid.user_id,
                },
                customer: {
                  email: this.currentPaymentBid.user_email,
                  phone_number: this.currentPaymentBid.phone_number,
                  name: this.currentPaymentBid.fullname,
                },
                customizations: {
                  title: "BIDDA",
                  description: `Payment for ${this.currentPaymentBid.product_name}`,
                  logo: "https://www.logolynx.com/images/logolynx/22/2239ca38f5505fbfce7e55bbc0604386.jpeg",
                },
              });
            } else {
              this.no_bid = true;
            }
          } else {
            this.no_bid = true;
          }
        });
    },
    makePayment(bid_id) {
      this.getBidByBidId(bid_id);
    },
    show_my_bid() {
      this.toogleProposed = true;
    },

    print_error(x) {
      return `<span class='text-danger'>${x}</span>`;
    },

    print_success(x) {
      return `<span class='text-success'>${x}</span>`;
    },
  },

  mounted() {
    this.getMyBids();
  },
}).mount("#wrapper");
