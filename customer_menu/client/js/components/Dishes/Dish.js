export class Dish extends HTMLElement{

    constructor(){
        super();
        this.btnText = 'Open';
        this.amount = 0;
        this.ordered = false;
        this.image = '';
        
    }

    get id(){return this.getAttribute('id')};
    get title(){return this.getAttribute('title');}
    get price(){return this.getAttribute('price');}
    get description(){return this.getAttribute('description');}
    
    get btnText(){return this.getAttribute('btn-text');}
    set btnText(val){this.setAttribute('btn-text',val);}
    get amount(){return this.getAttribute('amount');}
    set amount(val){this.setAttribute('amount',val);}
    get ordered(){return this.getAttribute('ordered');}
    set ordered(val){this.setAttribute('ordered',val);}

    static get observedAttributes(){
        return ['btn-text', 'amount'];
    }

    async getDishes(){
        //TODO ATTEMPT TO ONLY LOAD THE IMAGE ONCE THE "OPEN DISH INFO" IS CALLED
        let results = await fetch(`../../customer_menu/backend/api/Dishes.php?id=${this.id}&&image=1`)
                            .then(res=>res.json())
                            .catch(err=>console.error(err));
        
        return results;
    }

    attributeChangedCallback(prop, oldVal, newVal){

        if(prop === 'btn-text'){
            
            this.render();
            if(this.btnText === 'Close'){
                this.querySelector(`#btn-${this.id}`).click();
            }
            this.addButtonTxtListeners();
            this.addAmountListeners();
        }

        if(prop === 'amount'){
            
            this.addAmountListeners();
        }

        this.checkIfOrdered();
    }

    async connectedCallback(){
        this.image = await this.getDishes();
        this.render();
        this.addButtonTxtListeners();
        this.addAmountListeners();
        this.checkIfOrdered();
    }

    addButtonTxtListeners(){
        const btn = this.querySelector(`#btn-${this.id}`);
        btn.addEventListener('click', ()=>{
            this.btnText = this.btnText === 'Open' ? 'Close' : 'Open';
        })
    }

    addAmountListeners(){
        const amountButtonElement = this.querySelector(`amount-button`);
        amountButtonElement.children[0].querySelector(`#dcrBtn-amount-btn-${this.id}`).addEventListener('click', ()=>{
            if(this.amount>0){
                this.amount--;
            }
        });
        amountButtonElement.children[0].querySelector(`#incBtn-amount-btn-${this.id}`).addEventListener('click', ()=>{
            this.amount++;
        });
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
        <div id='${this.id}' class='row border border-dark'>
            <div class='col-2'>
                <amount-button id='amount-btn-${this.id}' amount='${this.amount}'></amount-button>
            </div>
            <h1 class='col-6'>
                ${this.title}
            </h1>
            <p class='dish-price col-2'>
                £${this.price}  
            </p>

            <div class='col-2'>
                <div class='dropdown'>
                    <button id='btn-${this.id}' class='border btn btn-primary' type='button' data-bs-toggle='collapse' data-bs-target='.extra-content-${this.id}' aria-expanded='false' aria-controls='extra-content-${this.id}'>
                        ${this.btnText}
                    </button>
                </div>
            </div>
            <div class='container collapse col-12 extra-content-${this.id}'>

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
