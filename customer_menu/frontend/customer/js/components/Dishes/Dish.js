export class Dish extends HTMLElement{

    constructor(){
        super();
        this.btnText = 'Open';
        this.amount = 0;
        this.ordered = false;
        this.image = '';
        
    }

    get dishId(){return this.getAttribute('id')};
    get title(){return this.getAttribute('title');}
    get price(){return this.getAttribute('price');}
    get description(){return this.getAttribute('description');}
    
    get btnText(){return this.getAttribute('btn-text');}
    set btnText(val){this.setAttribute('btn-text',val);}
    get ordered(){return this.getAttribute('ordered');}
    set ordered(val){this.setAttribute('ordered',val);}

    static get observedAttributes(){
        return ['btn-text'];
    }

    async getImage(){
        let results = await fetch(`../../backend/api/Dishes.php?dishId=${this.dishId}&&image=1`)
                            .then(res=>res.json())
                            .catch(err=>console.error(err));
        
        return results;
    }
    
    attributeChangedCallback(prop, oldVal, newVal){
        this.checkIfOrdered();
    }

    async connectedCallback(){
        this.image = await this.getImage();
        this.render();
        this.checkIfOrdered();
    }

    checkIfOrdered(){
        if(this.amount > 0 ){
            this.ordered = true;
        }else{
            this.ordered = false;
        }
    }

    render(){
        this.innerHTML=` 
        <div id='${this.dishId}' class='row border-top border-dark mt-1 py-2'>
            
            
            <div class='col-6'>
                <dish-options id='dish-options-${this.dishId}' dish-id='${this.dishId}'>
                </dish-options>
            </div>
            <div class='col-6 float-right'>
            
                <h3>
                    ${this.title}
                </h3>

                <div class='dropdown'>
                    <button id='btn-${this.dishId}' class='border btn btn-description' type='button' data-bs-toggle='collapse' data-bs-target='.extra-content-${this.dishId}' aria-expanded='false' aria-controls='extra-content-${this.dishId}'>
                        Show more
                    </button>
                </div>

            </div>
            <div class='container collapse col-12 extra-content-${this.dishId}'>

                <div class='row card-body'>

                    <div class='col-8'>
                        <img class='dish-image' src='data:image;base64,${this.image}'>
                    </div>

                    <div class='col-4 dish-extra-info'>
                        ${this.description}                        
                    </div>
                </div>
            </div>
        </div>
        `;
    }
}
