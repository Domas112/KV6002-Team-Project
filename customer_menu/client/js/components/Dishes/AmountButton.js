export class AmountButton extends HTMLElement{

    constructor(){
        super();
        this.tracked = false;
    }

    get amount(){return this.getAttribute('amount');}
    set amount(val){this.setAttribute('amount',val);}
    get id(){return this.getAttribute('id');}
    set id(val){this.setAttribute('id',val);}
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

    addEventListeners(){
        let increaseBtn = this.querySelector(`#incBtn-${this.id}`);
        increaseBtn.addEventListener('click', ()=>{
            this.amount++;
            this.parentElement.amount++;
            
        })

        let decreaseBtn = this.querySelector(`#dcrBtn-${this.id}`);
        decreaseBtn.addEventListener('click', ()=>{
            if(this.amount > 0){
                this.amount--;
            }
        })

    }


    render(){
        this.innerHTML = `
            <div class='row-format'>
                <button id='dcrBtn-${this.id}' class='btn btn-danger dcrBtn'>
                -   
                </button>
                    <h2 class='amount' id='amount-${this.id}'>
                        ${this.amount}
                    </h2>
                <button id='incBtn-${this.id}' class='btn btn-success incBtn'>
                +
                </button>
            </div>
        `;
    }
}