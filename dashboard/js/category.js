let catLink = document.getElementsByName('category-link')
let slv = _('show-item');

// FOR EACH NAV LINK 
catLink.forEach(
    function(el){
        el.onclick = function (event) {
            event.preventDefault();
            id = this.id;
            slv.innerHTML = '<div class="fa-size"><span><i class="fa fa-refresh fa-spin"></i></span></div>';

            if (id === "viewcat") {
                $.ajax({
                    url: './control/action.php',
                    method: 'POST',
                    data: {
                        viewCat: 'viewCat'
                    }, 
                    success: function (data) {
                        slv.innerHTML = data;
                       
                    }
                })
            }else if(id === "addcat"){
                // SEND FOR CATEGORY FORM 
                $.ajax({
                    url: './control/forms.php',
                    method: 'POST',
                    data: {
                        aCForm: 'viewcat'

                    }, 
                    success: function (data) {
                        slv.innerHTML = data;
                    }
                    
                }).done(
                    function () {
                        let cf = _('category-form');
                        let cn = _('category-name');
                        let p = _('password');
                        let btnCf = _('btn-af');
                        let cfe = _('error-cf');
                        cf.onsubmit = function (event) {
                            event.preventDefault();
                            if (cn.value.trim() !=="" && p.value.trim() !=="") {
                                // cfe.innerHTML = "<span class='text-info'>GOOD TO GO </span>";
                                $.ajax({
                                    url: './control/action.php',
                                    method: 'POST',
                                    data: {
                                        cn: cn.value,
                                        p: p.value,
                                        catAdd: 'catAdd'
                                    }, 
                                    beforeSend: function () {
                                        btnCf.innerHTML = '<i class="fa fa-circle-o-notch fa-spin"></i> Sending...';
                                        btnCf.disabled = true;
                                    }, 
                                    success: function (data) {
                                        cfe.innerHTML = data;
                                        cfe.style.visibility = 'visible'
                                        btnCf.innerHTML = 'Add';
                                        btnCf.disabled = false;
                                    }
                                })
                            }else{
                                cfe.innerHTML = "<span class='text-danger'>ALL FIELD REQUIRED </span>";
                            }


                        }
                    }
                )
            }else {
                
            }
        }
    }
);