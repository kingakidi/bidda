<div id="bids">

<div class='p-2 m-2'>
  <button class="btn bg-blue-500 text-white hover:bg-blue-500 hover:text-white m-2" @click="show_my_bid()">My Bids Products </button>
  <button class="btn bg-blue-500 text-white hover:bg-blue-500 hover:text-white m-2" @click="proposedBids()">Proposed Bid</button>
  </div>

  <table class="table table-auto" v-if="toogleProposed">
    <thead>
      <tr>
        <th>No.</th>
        <th>Product</th>
        <th>Starting Amount</th>
      
        <td>Action</td>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(bid, index) in bids">
            <td> {{index + 1}} </td>
            <td>{{bid.name}}</td> 
            <td>{{bid.price}}</td>
            <td> 
                <button class="btn bg-blue-500 text-white hover:text-white hover:bg-blue-500 focus:text-white focus:bg-blue-500" @click="viewBids(bid.id)"> View  Bids</button> 

            </td>
      </tr>
    
    </tbody>
  </table>


  <div v-if="!toogleProposed">
    <h2 class="m-2">Proposed Bids</h2>

    <table class="table table-auto" >
    <thead>
      <tr>
        <th>No.</th>
        <th>Product</th>
        <th>Starting Amount</th>
        <th>Amount Proposed </th>  

        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(bid, index) in proposedBid">
      
            <td> {{index + 1}} </td>
            <td>{{bid.product_name}}</td> 
            <td>{{bid.product_price}}</td>
            <td>{{bid.bidder_amount}}</td>

            <td> 
                <div v-if="bid.isWon > 0" class='mb-2'> 
                    <div v-if="bid.bidder_status === 'win'" class="text-xs mb-2 text-orange-900">
                     <div> you win the bids, click the button below to makes payment</div>
                     <button class="btn bg-green-900 text-white hover:text-white hover:bg-green-900 focus:text-white focus:bg-green-900" @click="makePayment(bid.bids_id)"> Checkout ({{bid.bidder_amount}})</button> 
                    </div>

                  
                    <span v-else="">
                  
                    <button disabled class="rounded p-2 bg-red-500 text-white hover:text-white hover:bg-red-500 focus:text-white focus:bg-red-500"> Bid won by someone else </button> 
                </span>
                </div>

                <span v-else>
                  <button class="btn bg-blue-500 text-white hover:text-white hover:bg-blue-500 focus:text-white focus:bg-blue-500">{{bid.bidder_status}}  </button> 
                </span>
                

            </td>
      </tr>
    
    </tbody>
  </table>
  </div>
 
</div>

<div class="popup-page popup-page display-popup" id="popup-page"  ref="popup">
    <div class="popup-content" id="popup-content">
        <div class="popup-close text-right mb-4" @click="toggle_popup()">
            <button id="btn-popup-close" class="btn bg-red-900 text-white"><i class="fa fa-window-close" aria-hidden="true"></i></button>
        </div>
        
        <div class="popup-show" id="popup-show">
            <div v-for="bid in currentBid" class="flex rounded justify-between mb-3 text-sm items-center bg-cyan-500 p-3 text-white">
                <div>{{bid.product_name}}</div> - 
                <div> {{bid.fullname}} </div>

                <div> {{bid.phone_number}} </div>
                <div> {{bid.amount}} </div>

                <div> <button v-if="!currentBidWon" class="btn bg-blue-600 text-white text-sm hover:bg-blue-600 hover:text-white hover:text-sm focus:bg-blue-600 focus:text-white focus:text-sm" @click="selectBidWinner(bid.product_id, bid.user_id)"> Select </button> </div>

                <button v-if="currentBidWon" class="btn bg-blue-600 text-white text-sm hover:bg-blue-600 hover:text-white hover:text-sm focus:bg-blue-600 focus:text-white focus:text-sm"> 
                  
                <span v-if="bid.bid_status == 'win'"> Winner </span> <span v-else> --- </span> </button> </div>

            </div>
            <div v-html="show_bid_status"></div>
      
            <div v-if="no_bid" class="flex justify-center items-center text-3xl">
              NO BID YET FOR THIS PRODUCT
            </div>
        </div>
    </div>
</div>

