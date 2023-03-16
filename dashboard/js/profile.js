let plink = document.getElementsByName('p-link');
let slv = _('show-item');
function clean(x) {
    return x.value.trim().length
}


plink.forEach(
    function(element){
        element.onclick= function (event) {
            event.preventDefault();
            id = this.id;

            slv.innerHTML = '<div class="fa-size"><span><i class="fa fa-refresh fa-spin"></i></span></div>';
            if (id === 'viewprofile') {
                         
                $.ajax({
                    url: './control/action.php',
                    method: 'POST',
                    data: {
                        myProducts: 'myProducts'
                    },
                    success: function (data) {
                        slv.innerHTML = data;
                  
                    }

                })
            }else if(id === 'personaldetails'){
                $.ajax({
                    url: './control/forms.php',
                    method: 'POST',
                    data: {
                        personalform: 'personalform'
                    },
                    success: function (data) {
                        slv.innerHTML = data;
                    }
                }).done(
                  function () {
                    let pf = _('profile-form')
                    let dob = _('dob');
                    let address = _('address');
                    let city = _('city');
                    let state = _('state');
                    let pbs = _('profile-btn-submit');
                    let pfe = _('profile-form-error');
                    pf.onsubmit = function (event) {
                        event.preventDefault();

                        if (clean(dob) > 0 && clean(address) > 0 && clean(city) > 0 && clean(state) > 0) {
                         
                            // SEND UPDATE PROFILE AJAX 
                            $.ajax({
                                url: './control/action.php',
                                method: 'POST',
                                data: {
                                   
                                    dob: dob.value,
                                    address: address.value,
                                    city: city.value, 
                                    state: state.value,
                                    userProfileUpdate: 'userProfileUpdate'
                                },
                                beforeSend: function () {
                                    pbs.disabled = true;
                                    pbs.innerHTML = '<i class="fa fa-circle-o-notch fa-spin"> </i> Updating...';
                                }, 
                                success: function (data) {
                                    pfe.innerHTML = data;
                                    pfe.style.visibility = "visible"
                                    pbs.disabled = false;
                                    pbs.innerHTML = 'Update';
                                }
                            })
                        }else{
                            pfe.innerHTML = "<span class='text-danger'>ALL FIELD REQUIRED</span>";
                            pfe.style.visibility = "visible"
                        }
                        
                       
                    }
                  }
                )
                // SEND AJAX FOR ADD PRODUCTS 
            }else if(id === 'settlementaccount'){
             
                // BRING SETTLEMENT FORM
                $.ajax({
                    url: './control/forms.php',
                    method: 'POST',
                    data: {
                        settlementform: 'settlementform'
                    },
                    success: function (data) {
                        slv.innerHTML = data;
                    }

                }).done(function () {
                    let country = _('country');
                    let sf = _('settlement-form')

                    // FECTCHING BANK ON CHANGE 
                        country.onchange = function () {
                            let cn = this.value;

                            // SELECT BANKS BASE ON COUNTRY 
                            if (cn.trim() !== "") {
                                // CHECK IF THE COUNTRY IS UK 
                                if (cn.toLowerCase() === 'uk') {

                                    _('banks').innerHTML = '<option value="uk">UK</option>';

                                }else{
                                    // IF NOT UK BANK SEND AJAX REQUEST 
                                    $.ajax({
                                        url: './control/action.php',
                                        method: 'POST',
                                        data:{
                                            fetchBanks: cn
                                        }, 
                                        beforeSend: function () {
                                            _('banks').innerHTML = '<option value="">Loading..</option>';
                                        },
                            
                                        success: function (data) {
                                            _('banks').innerHTML = data;
                                            // console.log(data)
                                        }
                                    })
                                }
                                
                            }else{
                                _('banks').innerHTML = '<option value="">Select Country First</option>';
                            }
                        }
                    // END OF FETCH BANK 
                    // ONSUBMITTING THE SETTLEMENT FORM 
                    sf.onsubmit = function(event){
                        event.preventDefault();
                        let tn = _('trading-name');
                        let acn = _('account-number');
                        let c = _('country');
                        let bank = _('banks');
                        
                        let sbs = _('settlement-btn-submit');
                        let sfe = _('settlement-form-error');
                        if (clean(tn) > 0 && clean(acn) > 0 && clean(c) > 0 && clean(bank) > 0) {
                            
                            // SEND UPDATE PROFILE AJAX 
                            $.ajax({
                                url: './control/action.php',
                                method: 'POST',
                                data: {
                                    tn: tn.value, 
                                    act: acn.value,
                                    c: c.value,
                                    bank: bank.value, 
                                   
                                    settlementSubmitForm: 'settlementSubmitForm'
                                },
                                beforeSend: function () {
                                    sbs.disabled = true;
                                    sbs.innerHTML = '<i class="fa fa-circle-o-notch fa-spin"> </i> Updating...';
                                    sfe.innerHTML = ""
                                }, 
                                success: function (data) {
                                    sfe.innerHTML = data;
                                    sfe.style.visibility = "visible"
                                    sbs.disabled = false;
                                    sbs.innerHTML = 'Update';
                                }
                            })
                        }else{
                            sfe.innerHTML = "<span class='text-danger'>ALL FIELD REQUIRED</span>";
                            sfe.style.visibility = "visible"
                        }
                   
                    }
                    // END OF SETTLEMENT FORM

                })
            }else if(id === 'riderdetails'){
                $.ajax({
                    url: './control/forms.php',
                    method: 'POST',
                    data: {
                        ridersForm: 'ridersForm'
                    },
                    success: function (data) {
                        slv.innerHTML = data;
                    }

                }).done(
                    function () {
                        let riderName = _('riderName');
                        let showInfo = _('show-info');
                        riderName.onchange = function (event) {
                           showInfo.innerHTML = '<i class="fa fa-circle-o-notch fa-spin" id="large"></i>';

                            if (clean(riderName)) {
                                // SEND AJAX 
                                $.ajax({
                                    url: './control/forms.php',
                                    method: 'POST',
                                    data: {
                                        merchantRiderInfo: "merchantRiderInfo",
                                        riderId: riderName.value
                                    },
                                    beforeSend: function () {
                                        
                                    }, 
                                    success: function (data) {
                                        showInfo.innerHTML = data;
                                    }
                                }).done(
                                    function () {
                                       let brm =  _('btn-rider-merchant');
                                       let frm = _('riderForm');
                                       let frme = _('riderForm-error')
                                       frm.onsubmit = function (event) {
                                           event.preventDefault();
                                           if (riderName.value.trim() !== "") {
                                            //    SEND AJAX
                                            $.ajax({
                                                url: './control/action.php',
                                                method: 'POST',
                                                data: {
                                                    riderId: riderName.value, 
                                                    mRAS: "mRAS"
                                                },
                                                beforeSend: function () {
                                                    brm.disabled = true;
                                                    brm.innerHTML = '<i class="fa fa-circle-o-notch fa-spin" "></i> Adding';
                                                    // frme.innerHTML = '<i class="fa fa-circle-o-notch fa-spin fa-2x" "></i>'
                                                }, 
                                                success: function (data) {
                                                    frme.innerHTML = data;
                                                    brm.disabled = false;
                                                    brm.innerHTML = "Add"
                                                }
                                            })
                                           }

                                       }
                                    }
                                )
                            }
                        }
                    }
                )
            }
        }
    }
);