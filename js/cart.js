    
    
    let qty = document.getElementsByName('qty[]');
    let total = document.getElementsByName('total');
   
    function totalPrice(x) {
        let v = 0;
        x.forEach(element => {
           
            v = Number(v) + Number(element.value);
        });

            return v
    }
  

    qty.forEach(function (el) {
        function removeCommas(str) {
            while (str.search(",") >= 0) {
                str = (str + "").replace(',', '');
            }
            return str;
        }


        
        let pId = el.id;
        let id = pId.split('-')[1]
        let tId = _(id);
        let qty = _(`qty-${id}`)
        let price = _(`price-${id}`);
        let pValue = removeCommas(price.value)
   
        tId.value = `${Number(qty.value)*Number(pValue)}`;
        _('totalCartPrice').value = Number(totalPrice(total))
        // ON KEYUP 
        el.onkeyup = function(){
            let pId = el.id;
            let id = pId.split('-')[1]
            let tId = _(id);
            let qty = _(`qty-${id}`)
            let price = _(`price-${id}`);
            let pValue = removeCommas(price.value)
            if (Math.sign(qty.value) ==="-") {
                this.value = "1"
                tId.value = `${Number(qty.value)*Number(pValue)}`;
            }else if(qty.value === "0"){
                this.value = 1
                tId.value = `${Number(qty.value)*Number(pValue)}`;
            }else if(qty.value === ""){
                this.value = 1
                tId.value = `${Number(qty.value)*Number(pValue)}`;
            }else{
                qty.value = qty.value
                tId.value = `${Number(qty.value)*Number(pValue)}`;
            }
            _('totalCartPrice').value = totalPrice(total)
        }

        // ON MOUSEUP 
        el.onmouseup = function(){
            let pId = el.id;
            let id = pId.split('-')[1]
            let tId = _(id);
            let qty = _(`qty-${id}`)
            let price = _(`price-${id}`);
            let pValue = removeCommas(price.value)
            if (Math.sign(qty.value) ==="-") {
                this.value = "1"
                tId.value = `${Number(qty.value)*Number(pValue)}`;
            }else if(qty.value === "0"){
                this.value = 1
                tId.value = `${Number(qty.value)*Number(pValue)}`;
            }else{
                qty.value = qty.value
                tId.value = `${Number(qty.value)*Number(pValue)}`;
            }
            _('totalCartPrice').value = totalPrice(total)
        }

        // ON BLUR 
        el.onblur = function(){
            let pId = el.id;
            let id = pId.split('-')[1]
            let tId = _(id);
            let qty = _(`qty-${id}`)
            let price = _(`price-${id}`);
            let pValue = removeCommas(price.value)
            if (Math.sign(qty.value) ==="-") {
                this.value = "1"
                tId.value = `${Number(qty.value)*Number(pValue)}`;
            }else if(qty.value === "0"){
                this.value = 1
                tId.value = `${Number(qty.value)*Number(pValue)}`;
            }else{
                qty.value = qty.value
                tId.value = `${Number(qty.value)*Number(pValue)}`;
            }
            _('totalCartPrice').value = totalPrice(total)
        }




    })
    // total.value = `N ${Number(qty.value)*Number(price.value)}`;
    // el.onkeyup = function(){
    //     console.log(this.value)
    //     if (Math.sign(this.value) ==="-") {
    //         this.value = "1"
    //         total.value = `N ${Number(qty.value)*Number(price.value)}`;
    //     }else if(this.value === "0"){
    //         this.value = 1
    //         total.value = `N ${Number(qty.value)*Number(price.value)}`;
    //     }else{
    //         this.value = this.value
    //         total.value = `N ${Number(qty.value)*Number(price.value)}`;
    //     }
    // }
    // qty.onmouseup = function(){
    //     console.log(this.value)
    //     if (Math.sign(this.value) ==="-") {
    //         this.value = "1"
    //         total.value = `N ${Number(qty.value)*Number(price.value)}`;
    //     }else{
    //         this.value = this.value
    //         total.value = `N ${Number(qty.value)*Number(price.value)}`;
    //     }
    // }
    // qty.onblur = function () {
    //     console.log(this.value)
    //     if (this.value === "" || this.value === "0") {
    //         this.value = 1;

    //         this.value = this.value
    //         total.value = `N ${Number(qty.value)*Number(price.value)}`;

    //     }
    // }
