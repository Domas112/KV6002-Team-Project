export class DishesList extends HTMLElement{
    constructor(){
        super();
        this.dishes = [];

    }

    async getDishes(){
        let results = await fetch(`../../backend/api/Dishes.php?category=${this.category}&&dishes`)
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
        
        for (const dish of this.dishes) {
            this.innerHTML+=`
                <dish-component
                    id="${dish.dishID}"
                    title="${dish.dishName}"
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