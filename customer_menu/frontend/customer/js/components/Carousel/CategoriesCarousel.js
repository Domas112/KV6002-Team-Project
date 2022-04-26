export class CategoriesCarousel extends HTMLElement{
    constructor(){
        super();
    }

    attributeChangedCallback(){

    }

    async connectedCallback(){
        this.render();
        fetch('../../backend/api/Dishes.php?category')
            .then(res=>res.json())
            .then(res=>{
                let carouselContentPlaceholder = `
                    <div class="carousel-item active">
                        <h2>Welcome to the restaurant Amaysia</h2>
                        <p>This is a digital menu, here you may order food from your mobile device!</p>
                        <p>Feel free to browse through the categories of our offered food. 
                        Once you find something you would like to order, specify the amount, by clicking the + or - buttons to increase or decrease the amount of that dish.
                        Some dishes may have different options, so don't forget to check them out, they can be found above the amount buttons!
                        </p>
                        <p>
                        Once you are done with your orders, click the "Checkout" button at the top-right corner of the page.
                        There you will be able to review the items you ordered and proceed to payment options.</p>
                    </div>
                `;
                let carouselIndicatorsPlaceholder = `
                    <button 
                        type="button"
                        data-bs-target="#categoricalDishesCarousel" 
                        data-bs-slide-to="0" 
                        class="active" aria-current="true" 
                        aria-label="welcome-page">
                            Welcome
                    </button>
                
                `;
                let dontSkip = false;
                for (const key in res) {
                    
                    carouselIndicatorsPlaceholder += `
                        <button 
                            type="button" 
                            data-bs-target="#categoricalDishesCarousel" 
                            data-bs-slide-to="${parseInt(key)+1}"
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
                    
                    dontSkip = true;

                    document.querySelector('.carousel-inner').innerHTML = carouselContentPlaceholder;
                    document.querySelector('.scrollmenu').innerHTML = carouselIndicatorsPlaceholder;
                    
                }

            })
            .catch(err=>console.error(err));
    }

    render(){
        this.innerHTML=`
            <div class="carousel carousel-dark slide" data-bs-interval="false">
                <div class="category-indicators scrollmenu">

                </div>
            </div>
        `;
    }
}