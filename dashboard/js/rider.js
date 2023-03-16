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
                        viewRider: 'viewRider'
                    },
                    success: function (data) {
                        slv.innerHTML = data;
                  
                    }

                })
            }else if(id === "companyrecord"){
                $.ajax({
                    url: './control/forms.php',
                    method: "POST",
                    data: {
                        riderCompanyRecord: 'riderCompanyRecord' 
                    }, 
                    success: function (data) {
                        slv.innerHTML = data 
                    }
                }).done(
                    function () {
                        let rCRForm = _('rider-form');
                        let cName = _('company-name');
                        let cAddress = _('company-address');
                        let nFleet = _('number-of-fleet');
                        let cPhone = _('company-phone');
                        let btnUpdate = _('btn-update')
                      
                        let companyFile = _("company-file");
                        let cfe = _("company-form-error");
                        let showFileInfo = _("show-file-info");
                        

                        companyFile.onchange = function () {

                        let files = companyFile.files;
                        showFileInfo.innerHTML = "";

                        if (files.length > 0) {
                            // IF FILES IS CHOOSEN
                            let type = files[0].type;
                            let name = files[0].name;
                            let size = (files[0].size)/1000000;
                           
                            if (
                                type === "application/pdf" 
                            ) {
                                let message = `NAME: ${name} <br> TYPE: ${type} <br> SIZE: ${(Math.round(size)).toFixed(2)} MB`;
                                showFileInfo.innerHTML += message;
                            } else {
                                showFileInfo.innerHTML += `NAME: ${name} <br> TYPE:  <strong> INVALID FILE TYPE </strong>`;
                            }
                        } else {
                            showFileInfo.innerHTML = "NO FILE SELECTED";
                        }
                        };

                        // SUBMITTING JQUERY AJAX REQUEST 
                        rCRForm.onsubmit = function (event) {
                            event.preventDefault();
                            // CHECK FOR ALL FIELDS 
                                // CHECK IF ALL FIELD IS SELECTED 
                                let files = companyFile.files;
                                
                                if (clean(cName) > 0 && clean(cAddress) > 0 && clean(nFleet) > 0 && clean(cPhone) > 0 && files.length > 0) {
                                  
                                    let type = files[0].type;
                                    let name = files[0].name;
                                    let size = (files[0].size)/1000000;
                                    if (type === "application/pdf") {
                                        // SEND AJAX 
                                        const fileAjax = new XMLHttpRequest();
                                        const fd = new FormData();
                                        fileAjax.open("POST", "./control/action.php", true);
                                        fileAjax.onreadystatechange = function () {
                                            if (fileAjax.readyState == 4 && fileAjax.status == 200) {
                                                cfe.innerHTML = this.responseText;
                                                cfe.style.visibility = "visible"
                                            }
                                        };

                                        
                                        fd.append("scDetails", "scDetails")
                                        fd.append("cFile", files[0]);
                                        fd.append("cName", cName.value);
                                        fd.append("cAddress", cAddress.value)
                                        fd.append("cPhone", cPhone.value);
                                        fd.append("nFleet", nFleet.value)
                                        // Initiate a multipart/form-data upload

                                        fileAjax.send(fd);
                                    }else{
                                        cfe.innerHTML = "<span class='text-danger'> INVALID FILE TYPE SELECTED </span>"
                                        cfe.style.visibility = "visible"
                                    }
                                }else{
                                    cfe.innerHTML = "<span class='text-danger'> ALL FIELD REQUIRED </span>"
                                    cfe.style.visibility = 'visible'
                                }
                                
                        }
                    }
                )
            }else if(id ==='settlement'){
                $.ajax({
                    url: './control/forms.php', 
                    method: "POST",
                    data: {
                        riderSettlement: 'riderSettlement'
                    },
                    success: function (data) {
                        slv.innerHTML = data;
                    }

                }).done(
                    function () {
                        let country = _('country');
                        let sf = _('settlement-form')
                        let acn = _('account-number');
                        let banks = _('banks');
                        let sfe = _('settlement-form-error')
                        let sbs = _('settlement-btn-submit')
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
                                            
                                        }
                                    })
                                }
                                
                            }else{
                                _('banks').innerHTML = '<option value="">Select Country First</option>';
                            }
                        }
                        
                        // SUBMITTING SETTLEMENT FORM 
                        sf.onsubmit = function (event) {
                            event.preventDefault();
                            if (clean(country) < 1 || clean(acn) < 1 || clean(banks) < 1) {
                                sfe.innerHTML = "ALL FIELDS REQUIRED";
                                sfe.style.visibility = "visible";
                            }else{
                                // SEND AJAX 
                                $.ajax({
                                    url: "./control/action.php",
                                    method: "POST",
                                    data: {
                                        rsU: "1",
                                        acn: acn.value, 
                                        bank: banks.value,
                                        country: country.value
                                        
                                    },
                                    beforeSend: function () {
                                        sbs.innerHTML = '<i class="fa fa-circle-o-notch fa-spin"> </i> Updating...'
                                        sbs.disabled = true;
                                    },
                                    success: function (data) {
                                        sfe.innerHTML = data;
                                        sfe.style.visibility = 'visible'
                                        sbs.innerHTML = "Update"
                                        sbs.disabled = false;
                                    }
                                })
                            }
                        }
                    }
                )
            }else if(id === 'orders'){
                           console.log(id)
                $.ajax({
                    url: './control/action.php', 
                    method: "POST",
                    data: {
                        deliveryRequest: 'deliveryRequest'
                    },
                    success: function (data) {
                        slv.innerHTML = data;
                    }

                })
            }
        }
    }
);