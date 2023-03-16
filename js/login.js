let lf = _('login');
let u = _('username');
let p = _('password');
let bl = _('btn-login');
let le = _('login-error');

lf.onsubmit = function (event) {
    event.preventDefault();
    if (check(u) && check(p)) {
        le.style.visibility = 'visible';

        // SEND DATA 

        $.ajax({
            type: "POST",
            url: './control/action.php',
            data: {
                u: u.value, 
                p: p.value,
                login: '1'
            },
            beforeSend: function () {
                bl.innerHTML = '<i class="fa fa-refresh fa-spin"></i> Logging...' 
               bl.disabled = true;
            }, 
            success: function (data) {

                if (data.trim() === "<span class='text-success'>VERIFY SUCCESSFULLY</span>") {
                    bl.value = '<i class="fa fa-circle-o-notch fa-spin"></i> Redirecting...' 
                    bl.disabled = true;
                    window.location = './dashboard/';
                }else{
                    le.innerHTML = data;
                    le.style.visibility = 'visible'
                    bl.innerHTML = 'Signup'
                    bl.disabled = false;
                }
                
            }
        })
        
    }else{
        le.style.visibility = 'visible';
        le.innerHTML = error('ALL FIELD REQUIRED');
    }
    


}