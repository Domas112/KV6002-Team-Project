export class DishesList extends HTMLElement{
    constructor(){
        super();
        this.dishes = [];

    }

    async getDishes(){
        let results = await fetch(`../../customer_menu/backend/apis/Dishes.php?category=${this.category}`)
                            .then(res=>res.json())
                            .catch(err=>console.error(err));
        
        return results;
    }
    
    get category(){return this.getAttribute('category');}
    set category(val){this.setAttribute('category',val);}

    static get observedAttributes(){
        return ["amount"];
    }

    attributeChangedCallback(prop, oldVal, newVal){
        this.render();
    }

    async connectedCallback(){
        
        this.dishes = await this.getDishes();
        this.render();
    }

    render(){
        
        console.log(this.dishes);
        for (const dish of this.dishes) {
            console.log(dish);
            this.innerHTML+=`
                <dish-component
                    id="${dish.dishID}"
                    title="${dish.dishName}"
                    price="${dish.dishPrice}"
                    description="${dish.dishDescription}"
                />
            `;
        }
        // this.dishes.category_1.forEach(element => {
        //     this.innerHTML+=`
        //         <dish-component
        //             id="${element.id}"
        //             title="${element.title}"
        //             price="${element.price}"
        //             description="${element.description}"
        //             image-path="${element.imagePath}"
        //         />
        //     `;
           
        // });
    }
}