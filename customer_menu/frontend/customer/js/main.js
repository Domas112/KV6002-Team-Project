import { Dish } from './components/Dishes/Dish.js';
import { AmountButton} from './components/Dishes/AmountButton.js';
import { DishesList } from './components/Dishes/DishesList.js';
import { Checkout } from './components/Checkout/Checkout.js';
import { OrdersSum } from './components/Orders/Orders.js';
import {DishOptions} from './components/Dishes/DishOptions.js';

window.addEventListener('load', ()=>{
    defineElements();    

    fetch('../../backend/api/Dishes.php?category=1&&dishes=0')
    .then(res=>res.json())
    .then(res=>{
        console.log(res[0].categoryName);
        let carouselContentPlaceholder = `
        
            <div class="carousel-item active">
                <h2>${res[0].categoryName}</h2>
                <dishes-component category="${res[0].categoryID}"></dishes-component>
            </div>
        
        `;
        let carouselIndicatorsPlaceholder = `
            <button 
                type="button"
                data-bs-target="#categoricalDishesCarousel" 
                data-bs-slide-to="0" 
                class="active" aria-current="true" 
                aria-label="${res[0].categoryName}">
                    ${res[0].categoryName}
            </button>
        
        `;
        let dontSkip = false;
        for (const key in res) {
            if(dontSkip){
                carouselIndicatorsPlaceholder += `
                    <button 
                        type="button" 
                        data-bs-target="#categoricalDishesCarousel" 
                        data-bs-slide-to="${key}"
                        aria-label="${res[key].categoryName}">
                            ${res[key].categoryName}
                    </button>
                `;
                
                carouselContentPlaceholder += `
                <div class="carousel-item">
                    <h2>${res[key].categoryName}</h2>
                    <dishes-component category="${res[key].categoryID}"></dishes-component>
                </div>
                `;
            }
            dontSkip = true;

            document.querySelector('.carousel-inner').innerHTML = carouselContentPlaceholder;
            document.querySelector('.scrollmenu').innerHTML = carouselIndicatorsPlaceholder;
            
        }

    })
    .catch(err=>console.error(err));
  

});


function defineElements(){
    window.customElements.define('amount-button', AmountButton);
    window.customElements.define('dish-options', DishOptions);
    window.customElements.define('dish-component', Dish);
    window.customElements.define('dishes-component', DishesList);
    window.customElements.define('checkout-component', Checkout);
    window.customElements.define('orders-component', OrdersSum);
}