export class DishOptions extends HTMLElement{

    constructor(test){
        super();

        this.dishOptions={};
        this.hasOptions=false;

        this.currentOptionPrice = 0;
        this.currentOptionId = 0;
        this.currentOptionName = 0;

        this.optionsTemplate = '';

        this.currentDishAmount = 0;

        this.parent = this.parentElement.parentElement.parentElement;

        this.init = true;
    }

    get dishId(){return this.getAttribute('dish-id')};
    set dishId(val){this.setAttribute('dish-id'),val};

    get currentOptionPrice(){return this.getAttribute('current-option-price');}
    set currentOptionPrice(val){this.setAttribute('current-option-price',val);}
    get currentOptionId(){return this.getAttribute('current-option-id');}
    set currentOptionId(val){this.setAttribute('current-option-id',val);}
    get currentOptionName(){return this.getAttribute('current-option-name');}
    set currentOptionName(val){this.setAttribute('current-option-name',val);}
    
    get currentDishAmount(){return this.getAttribute('current-dish-amount');}
    set currentDishAmount(val){this.setAttribute('current-dish-amount',val);}

    static get observedAttributes(){
        return ["current-option-id", "dish-id", "current-dish-amount"];
        
    }

    async getDishOptions(){
        await fetch(`../../backend/api/Dishes.php?dishId=${this.dishId}&&options=1`)
            .then(res=>res.json())
            .then(res=>{
                if(res.length > 1 ) this.hasOptions=true;

                for(let i = 0 ; i < res.length; i++){
                        
                    if(res[i].optionName == 'Regular' || !this.hasOptions){
                        this.currentOptionPrice = res[i].optionPrice;
                        this.currentOptionId = res[i].optionID;
                        this.currentOptionName = res[i].optionName;
                    }

                    this.dishOptions[res[i].optionID] = {
                        optionName:res[i].optionName, 
                        optionPrice:res[i].optionPrice,
                        amount: 0
                    }

                    this.optionsTemplate+= `
                        <option value='${res[i].optionID}'>${res[i].optionName}</option>
                    `;
                }

                if( this.currentOptionPrice == 0 &&
                    this.currentOptionId == 0 &&
                    this.currentOptionName == 0){
                    
                    this.currentOptionPrice = res[0].optionPrice;
                    this.currentOptionId = res[0].optionID;
                    this.currentOptionName = res[0].optionName;
                }

                this.init=false;
            })
            .catch(err=>console.error(err));

    }


    attributeChangedCallback(prop, oldVal, newVal){

        if(prop=='current-option-id' && !this.init){
            this.dishOptions[oldVal].amount = this.currentDishAmount; 
            this.currentOptionName = this.dishOptions[newVal].optionName;
            this.currentOptionPrice = this.dishOptions[newVal].optionPrice; 
            this.currentDishAmount = this.dishOptions[newVal].amount;
            this.render()
            this.addEventListeners();
            this.addAmountListeners();
        }

        if(prop == 'current-dish-amount'){
            const checkoutComponent = document.querySelector(`checkout-component`);
            checkoutComponent.setAttribute('new-order-name', this.parent.getAttribute('title'));
            checkoutComponent.setAttribute('new-order-option-name', this.currentOptionName);
            checkoutComponent.setAttribute('new-order-price', this.currentOptionPrice);
            checkoutComponent.setAttribute('new-order-amount', this.currentDishAmount);
            checkoutComponent.setAttribute('new-dish-id', this.dishId);
            checkoutComponent.setAttribute('new-option-id', this.currentOptionId);
            this.addAmountListeners();
        }
    }


    async connectedCallback(){
        await this.getDishOptions();
        this.render();
        this.addAmountListeners();
        this.addEventListeners();
    }

    addEventListeners(){
        if(this.hasOptions){

            const optionsSelect = this.querySelector(`#dish-options-select-${this.dishId}`);
            
            optionsSelect.value = this.currentOptionId;
            optionsSelect.addEventListener('change', (e)=>{
                let newId = e.target.value;
                this.currentOptionId = newId
            })
        }
    }

    addAmountListeners(){
        const amountButtonElement = this.querySelector(`amount-button`);
        amountButtonElement.children[0].querySelector(`#dcrBtn-amount-btn-${this.dishId}`).addEventListener('click', ()=>{
            if(this.currentDishAmount>0) this.currentDishAmount--;
        });
        amountButtonElement.children[0].querySelector(`#incBtn-amount-btn-${this.dishId}`).addEventListener('click', ()=>{
            this.currentDishAmount++;
        });
    }

    render(){
        this.innerHTML = `
            <select ${this.hasOptions?'enabled':'disabled'} id="dish-options-select-${this.dishId}" placeholder="select an option">
                ${this.optionsTemplate}
            </select>
            
            <p>${this.currentOptionPrice}</p>
            <amount-button id='amount-btn-${this.dishId}' amount='${this.currentDishAmount}'></amount-button>
        `;
    }
}