import {DishComponent} from './components/DishComponent.js';
import {DishAmountButton} from './components/DishAmountButton.js';
import { DishesList } from './components/DishesList.js';

window.addEventListener('load', ()=>{
    window.customElements.define('dish-amount-button', DishAmountButton);
    window.customElements.define('dish-component', DishComponent);
    window.customElements.define('dishes-list', DishesList);
    
})