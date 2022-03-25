import {Orders} from './components/Orders/Orders.js';
import {Order} from './components/Orders/Order.js';
import {OrdersLists} from './components/Orders/OrdersLists.js';

window.addEventListener('load', ()=>{
    console.log('Welcome to the staff page');
    defineElements();
})

function defineElements(){
    window.customElements.define('order-component', Order);
    window.customElements.define('orders-component', Orders);
    window.customElements.define('orders-lists-component', OrdersLists);

    
}