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