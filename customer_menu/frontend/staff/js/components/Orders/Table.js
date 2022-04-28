export class Table extends HTMLElement {
    constructor() {
        super();
    }

    get tableId() {return this.getAttribute("table-id");}
    set tableId(val) {this.setAttribute("table-id", val);}
    get index() {return this.getAttribute("index");}

    get show(){return (this.getAttribute("show") === 'true');}
    get vip(){return (this.getAttribute('vip')==='1')}

    static get observedAttributes() {
        return ['render'];
    }

    attributeChangedCallback(prop, oldVal, newVal) {
        if(prop == 'render'){
            this.render();
        }
    }

    connectedCallback() {
        this.render();
    }


    addClickListeners() {
    }

    render() {
        let placeholder = `
        <div class="row orders-table border-top border-dark pt-2">
            <controls-component id="table-${this.tableId}-controls" table-id=${this.tableId} show=${this.show} new-order="false" vip=${this.vip}></controls-component>
            <orders-component id="table-${this.tableId}-orders" table-id=${this.tableId} show=${this.show}></orders-component> 
        </div>
        `;
        this.innerHTML = placeholder;
    }
}
