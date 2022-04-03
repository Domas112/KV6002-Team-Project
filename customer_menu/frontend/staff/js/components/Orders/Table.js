export class Table extends HTMLElement {
    constructor() {
        super();
    }

    get tableId() {
        return this.getAttribute("table-id");
    }
    set tableId(val) {
        this.setAttribute("table-id", val);
    }
    get index() {
        return this.getAttribute("index");
    }

    get show(){
        return this.getAttribute("show");   
    }
    set show(val){
        this.setAttribute("show",val);
    }

    get orderCount(){
        return this.getAttribute('order-count')
    }

    static get observedAttributes() {
        return [];
    }

    attributeChangedCallback(prop, oldVal, newVal) {
        console.log(prop);
    }

    connectedCallback() {
        this.render();
    }


    addClickListeners() {
    }

    render() {
        let placeholder = `
        <div class="row border-top border-dark pt-2">
            <controls-component id="table-${this.tableId}-controls" table-id=${this.tableId} new-order='false'></controls-component>
            <orders-component id="table-${this.tableId}-orders" table-id=${this.tableId} show="${this.show}"></orders-component> 
        </div>
        `;
        this.innerHTML = placeholder;
    }
}
