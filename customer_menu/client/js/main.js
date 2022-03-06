import { Dish } from './components/Dishes/Dish.js';
import { AmountButton} from './components/Dishes/AmountButton.js';
import { DishesList } from './components/Dishes/DishesList.js';
import { Checkout } from './components/Checkout/Checkout.js';
import { Orders } from './components/Orders/Orders.js';

window.addEventListener('load', ()=>{
    defineElements();    
    const main = document.querySelector('main'); 
  

});


function defineElements(){
    window.customElements.define('amount-button', AmountButton);
    window.customElements.define('dish-component', Dish);
    window.customElements.define('dishes-component', DishesList);
    window.customElements.define('checkout-component', Checkout);
    window.customElements.define('orders-component', Orders);
}