import { Dish } from './components/Dishes/Dish.js';
import { AmountButton} from './components/Dishes/AmountButton.js';
import { DishesList } from './components/Dishes/DishesList.js';
import { Checkout } from './components/Checkout/Checkout.js';
import { Orders } from './components/Orders/Orders.js';
import { DishOptions } from './components/Dishes/DishOptions.js';
import { CategoriesCarousel } from './components/Carousel/CategoriesCarousel.js';

window.addEventListener('load', ()=>{
    defineElements();    
});


function defineElements(){
    window.customElements.define('categories-carousel-component', CategoriesCarousel);
    window.customElements.define('amount-button', AmountButton);
    window.customElements.define('dish-options', DishOptions);
    window.customElements.define('dish-component', Dish);
    window.customElements.define('dishes-component', DishesList);
    window.customElements.define('checkout-component', Checkout);
    window.customElements.define('orders-component', Orders);
}