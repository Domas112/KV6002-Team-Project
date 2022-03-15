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

        // if(prop === 'btn-text'){
            
        //     this.render();
        //     if(this.btnText === 'Close'){
        //         this.querySelector(`#btn-${this.id}`).click();
        //     }
        //     this.addButtonTxtListeners();
        //     this.addAmountListeners();
        // }

        this.checkIfOrdered();
    }

    async connectedCallback(){
        this.image = await this.getImage();
        this.render();
        this.addButtonTxtListeners();
        this.checkIfOrdered();
    }

    addButtonTxtListeners(){
        // const btn = this.querySelector(`#btn-${this.id}`);
        // btn.addEventListener('click', ()=>{
        //     this.btnText = this.btnText === 'Open' ? 'Close' : 'Open';
        // })
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
        <div id='${this.dishId}' class='row border border-dark'>
            
            
            <div class='col-6'>
                <dish-options id='dish-options-${this.dishId}' dish-id='${this.dishId}'>
                </dish-options>
            </div>
            <h1 class='col-4'>
                ${this.title}
            </h1>
            <div class='col-2'>
                <div class='dropdown'>
                    <button id='btn-${this.dishId}' class='border btn btn-primary' type='button' data-bs-toggle='collapse' data-bs-target='.extra-content-${this.dishId}' aria-expanded='false' aria-controls='extra-content-${this.dishId}'>
                        Description
                    </button>
                </div>
            </div>
            <div class='container collapse col-12 extra-content-${this.dishId}'>

                <div class='row card-body'>

                    <div class='col'>
                        <img class='dish-image' src='data:image;base64,${this.image}'>
                    </div>

                    <div class='col dish-extra-info'>
                        ${this.description}                        
                    </div>
                </div>
            </div>
        </div>
        `;
    }
}
