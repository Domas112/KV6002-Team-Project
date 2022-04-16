/**
 * logout.js
 * A script used to handle the logout function
 *
 * @author Teck Xun Tan W20003691
 */
let logoutButton = "button.logout";
let logoutURL = '../../account/loginapi.php?logout';

$(logoutButton).on("click", function(){
    //Call the logout function on logoutButton click
    logout();
})

/**
 * logout
 * A function used to call the logout API using AJAX in POST method to destroy the session and redirect user back
 * to the homepage
 */
function logout(){
    $.ajax({
        type: "POST",
        url: logoutURL,
        async: false,
        success: function(){
            //Redirect user back to homepage
            window.location.href = "http://unn-w19030982.newnumyspace.co.uk/kv6002/index.php";
        }
    })
}