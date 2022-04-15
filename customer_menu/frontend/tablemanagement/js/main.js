import {TablesList} from './components/TablesList.js';
import {TablesForm} from './components/TablesForm.js';
window.addEventListener('load', ()=>{
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