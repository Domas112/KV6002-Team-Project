export class AmountButton extends HTMLElement{

    constructor(){
        super();
        this.tracked = false;
    }

    get amount(){return this.getAttribute('amount');}
    set amount(val){this.setAttribute('amount',val);}
    get dishId(){return this.getAttribute('id');}
    set dishId(val){this.setAttribute('id',val);}
    get amountId(){return this.getAttribute('amountid');}
    set amountId(val){this.setAttribute('amountid',val);}

    static get observedAttributes(){
        return ["id", "amount"];
    }

    attributeChangedCallback(prop, oldVal, newVal){
        
        this.render();
        this.addEventListeners();
    }


    connectedCallback(){
        this.render();
        this.addEventListeners();
    }

    //Event listeners include only the amount buttons
    addEventListeners(){
        
        let increaseBtn = this.querySelector(`#incBtn-${this.dishId}`);
        increaseBtn.addEventListener('click', ()=>{
            //change the amount here, so the changes would be displayed
            this.amount++;
            
        })

        let decreaseBtn = this.querySelector(`#dcrBtn-${this.dishId}`);
        decreaseBtn.addEventListener('click', ()=>{
            
            //change the amount here, so the changes would be displayed
            //as well as do not allow the amount to go below 0
            if(this.amount > 0){
                this.amount--;
            }
        })

    }


    render(){
        this.innerHTML = `
            <div class='row-format'>
                <button id='dcrBtn-${this.dishId}' class='btn dcrBtn'>
                    <i class="fas fa-minus"></i>
                </button>
                    <h2 class='amount' id='${this.dishId}'>
                        ${this.amount}
                    </h2>
                <button id='incBtn-${this.dishId}' class='btn incBtn'>
                    <i class="fas fa-plus"></i>
                </button>
                
            </div>
        `;
    }
}