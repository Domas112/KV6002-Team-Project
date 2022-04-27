let usernameInput = "input[name='username']";
let passwordInput = "input[name='password']";
let errorMessage = "span.error"
let authenticateURL = 'loginapi.php?authenticate';

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
                window.location.href = "http://unn-w19030982.newnumyspace.co.uk/kv6002/adminindex.php";
            },
            401: function(){
                $(errorMessage).html("Incorrect Username/Password. Please try again!");
            }
        }
    })
})