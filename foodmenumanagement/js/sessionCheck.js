let retrieveAccountTypeURL = '../../account/loginapi.php?accountType';
let checkAuthenticationURL = '../../account/loginapi.php?isLoggedIn';
let logoutButton = "button.logout";
let logoutURL = '../../account/loginapi.php?logout';

$("document").ready(function(){
    if(!checkIsLoggedIn()){
        window.location.href = "http://unn-w19030982.newnumyspace.co.uk/kv6002/foodmenumanagement/errorpage.php/401";
    }else{
        if(!verifyAccountType()){
            window.location.href = "http://unn-w19030982.newnumyspace.co.uk/kv6002/foodmenumanagement/errorpage.php/403";
        }
    }
})

$(logoutButton).on("click", function(){
    logout();
})

function checkIsLoggedIn(){
    let isLoggedIn;
    $.ajax({
        type: "POST",
        url: checkAuthenticationURL,
        dataType: 'json',
        async: false,
        success: function (result){
            isLoggedIn = result['authenticated'];
        }
    })
    return isLoggedIn === true;
}

function verifyAccountType(){
    let verifiedAccountType;
    $.ajax({
        type: "POST",
        url: retrieveAccountTypeURL,
        dataType: 'json',
        async: false,
        success: function (result){
            verifiedAccountType = result['accountType'];
        }
    })
    return verifiedAccountType === "1";
}

function logout(){
    $.ajax({
        type: "POST",
        url: logoutURL,
        async: false,
        success: function(){
            window.location.href = "http://unn-w19030982.newnumyspace.co.uk/kv6002/foodmenumanagement/foodmenucustomer.php/";
        }
    })
}