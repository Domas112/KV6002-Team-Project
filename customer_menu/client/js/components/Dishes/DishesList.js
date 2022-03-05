export class DishesList extends HTMLElement{
    constructor(){
        super();
        this.dishes = {
            'category_1' : [
                    {
                        'id': '1',
                        'title': 'dish name',
                        'price': '5.99',
                        'description': 'this dish is very tasty and definitely has some ingredients in it',
                        'imagePath': '../resources/images/dish_1.jpg'
                    },
                    {
                        'id': '2',
                        'title': 'new name',
                        'price': '11.99',
                        'description': 'this dish is very tasty as well and probably, definitely has some ingredients in it',
                        'imagePath': '../resources/images/dish_1.jpg'
                    }
                ]
        }

    }
    
    static get observedAttributes(){
        return ["amount"];
    }

    attributeChangedCallback(prop, oldVal, newVal){
        this.render();
    }

    connectedCallback(){
        this.render();
    }

    render(){
        
        this.dishes.category_1.forEach(element => {
            this.innerHTML+=`
                <dish-component
                    id="${element.id}"
                    title="${element.title}"
                    price="${element.price}"
                    description="${element.description}"
                    image-path="${element.imagePath}"
                />
            `;
           
        });
    }
}