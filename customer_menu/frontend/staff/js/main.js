import {OrdersComponent} from './components/Orders/OrdersComponent.js';
import {OrderComponent} from './components/Orders/OrderComponent.js';
import {OrdersTableComponent} from './components/Orders/OrdersTableComponent.js';

window.addEventListener('load', ()=>{
    console.log('Welcome to the staff page');
    defineElements();
})

function defineElements(){
    window.customElements.define('order-component', OrderComponent);
    window.customElements.define('orders-component', OrdersComponent);

    
    // window.customElements.define('orders-table-component', OrdersTableComponent);
}