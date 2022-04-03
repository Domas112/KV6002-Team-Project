import {Table} from './components/Orders/Table.js';
import {Orders} from './components/Orders/Orders.js';
import {Controls} from './components/Orders/Controls.js';
import {TablesList} from './components/Orders/TablesList.js';

window.addEventListener('load', ()=>{
    console.log('Welcome to the staff page');
    defineElements();
})

function defineElements(){
    window.customElements.define('controls-component', Controls);
    window.customElements.define('orders-component', Orders);
    window.customElements.define('table-component', Table);
    window.customElements.define('tables-lists-component', TablesList);

    
}