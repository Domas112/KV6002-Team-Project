import {TablesList} from './components/TablesList.js';
import {TablesForm} from './components/TablesForm.js';
window.addEventListener('load', ()=>{
    //Check if the user is logged in as a staff member
    fetch('../../../account/loginapi.php?isLoggedIn',{
        method: 'POST'
    })
    .then(res=>res.json())
    .then(res=>{
        if(res['authenticated']===false){
            window.location.href = "http://unn-w19030982.newnumyspace.co.uk/kv6002/error.php?error=401";
        }
    })
    .catch(err=>{
        console.error(err);
    });
    
    //Add logout functionality to the logout button
    document.querySelector('.logout').addEventListener('click', ()=>{
        fetch('../../../account/loginapi.php?logout', {
            method: 'POST'
        })
        .then(res=>window.location.href = "http://unn-w19030982.newnumyspace.co.uk/kv6002/index.php")
        .catch(err=>console.error(err));
    })
    
    defineElements();
});

function defineElements(){
    window.customElements.define('tables-form', TablesForm);
    window.customElements.define('tables-list', TablesList);
}