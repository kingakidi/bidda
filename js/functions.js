// CHECK FORMS 

function check(x) {
    if (x.value.trim().length < 1) {
        return false;
    }else{
        return true;
    }
 }

// ERROR PRINTING FUNCTION 
function error(text)
{
    return `<span class='text-danger'>${text}</span>`;
}

// INFO PRINTING FUNCTION 
function info(text)
{
    return `<span class='text-info'>${text}</span>`;
}

// SUCCESS PRINTING FUNCTION 
function success(text)
{
    return `<span class='text-success'${text}</span>`;
}