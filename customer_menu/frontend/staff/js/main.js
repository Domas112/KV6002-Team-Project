import {Table} from './components/Orders/Table.js';
import {Orders} from './components/Orders/Orders.js';
import {Controls} from './components/Orders/Controls.js';
import {TablesList} from './components/Orders/TablesList.js';

window.addEventListener('load', ()=>{
    
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
    
    console.log('Welcome to the staff page');
    defineElements();
})

function defineElements(){
    window.customElements.define('controls-component', Controls);
    window.customElements.define('orders-component', Orders);
    window.customElements.define('table-component', Table);
    window.customElements.define('tables-lists-component', TablesList);

    
}