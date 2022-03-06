export class Dish extends HTMLElement{

    constructor(){
        super();
        this.btnText = 'Open';
        this.amount = 0;
        this.ordered = false;
    }

    get id(){return this.getAttribute('id')};
    get title(){return this.getAttribute('title');}
    get price(){return this.getAttribute('price');}
    get description(){return this.getAttribute('description');}
    get imagePath(){return this.getAttribute('image-path');}

    get btnText(){return this.getAttribute('btn-text');}
    set btnText(val){this.setAttribute('btn-text',val);}
    get amount(){return this.getAttribute('amount');}
    set amount(val){this.setAttribute('amount',val);}
    get ordered(){return this.getAttribute('ordered');}
    set ordered(val){this.setAttribute('ordered',val);}

    static get observedAttributes(){
        return ['btn-text', 'amount'];
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

    connectedCallback(){
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
        const checkoutElement = document.querySelector('checkout-component');
        amountButtonElement.children[0].querySelector(`#dcrBtn-amount-btn-${this.id}`).addEventListener('click', ()=>{
            if(this.amount>0){
                this.amount--;
                let totalItemsNumber = parseInt(checkoutElement.getAttribute('total-items-number'));
                checkoutElement.setAttribute('total-items-number',totalItemsNumber-1);
    
                let totalCost = parseFloat(checkoutElement.getAttribute('total-cost'));
                checkoutElement.setAttribute('total-cost', (totalCost-parseFloat(this.price)).toFixed(2));
            }
        });
        amountButtonElement.children[0].querySelector(`#incBtn-amount-btn-${this.id}`).addEventListener('click', ()=>{
            this.amount++;
            let totalItemsNumber = parseInt(checkoutElement.getAttribute('total-items-number'));
            checkoutElement.setAttribute('total-items-number',totalItemsNumber+1);

            
            let totalCost = parseFloat(checkoutElement.getAttribute('total-cost'));
            checkoutElement.setAttribute('total-cost', (totalCost+parseFloat(this.price)).toFixed(2));
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
                        <img class='dish-image' src='${this.imagePath}'>
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
