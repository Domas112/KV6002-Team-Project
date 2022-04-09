let usernameInput = "input[name='username']";
let passwordInput = "input[name='password']";
let errorMessage = "span.error"
let authenticateURL = 'loginapi.php?authenticate';
let checkAuthenticationURL = 'loginapi.php?isLoggedIn';

$("document").ready(function(){
    $.ajax({
        type: "POST",
        url: checkAuthenticationURL,
        dataType: 'json',
        async: false,
        success: function (result){
            if(result['authenticated'] === true){
                //Redirect to Admin Homepage
            }
        }
    })
})

$("#loginForm").on("submit", function(e){
    var formData = {
        username: $(usernameInput).val(),
        password: $(passwordInput).val()
    }
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: authenticateURL,
        data: formData,
        dataType: 'json',
        encode: true,
        async: false,
        statusCode:{
            200: function(){
                //Redirect to Admin Homepage
            },
            401: function(){
                $(errorMessage).html("<p>Incorrect Username/Password. Please try again!</p>");
            }
        }
    })
})