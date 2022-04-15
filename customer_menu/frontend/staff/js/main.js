import {Table} from './components/Orders/Table.js';
import {Orders} from './components/Orders/Orders.js';
import {Controls} from './components/Orders/Controls.js';
import {TablesList} from './components/Orders/TablesList.js';

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
})

function defineElements(){
    window.customElements.define('controls-component', Controls);
    window.customElements.define('orders-component', Orders);
    window.customElements.define('table-component', Table);
    window.customElements.define('tables-lists-component', TablesList);
}