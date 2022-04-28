let logoutURL = '.././account/loginapi.php?logout';

function logout(){
    $.ajax({
        type: "POST",
        url: logoutURL,
        async: false,
        success: function(){
            window.location.href = "http://unn-w19030982.newnumyspace.co.uk/kv6002/index.php";
            console.log('done')
        }
    })
}