export class OrdersLists extends HTMLElement{
    constructor(){
        super();
        this.tables;
    }

    static get observedAttributes(){
        return [];
    }

    attributeChangedCallback(){

    }

    async connectedCallback(){
        await this.populateTables();
        setInterval(async()=>{
            await this.populateTables();
        }, 10000);
        
    }

    async populateTables(){
        await fetch('../../backend/api/Orders.php?get_tables')
            .then(res=>res.json())
            .then(res=>{
                this.tables = res;
                this.render();
            })
            .catch(err=>console.error(err));
    }

    render(){
        let placeholder = ``;
        for(const tableId in this.tables){
            console.log(this.tables[tableId].tableID);

            placeholder += `
                <orders-component table-id=${this.tables[tableId].tableID}></orders-component>

            `;
        }

        this.innerHTML = placeholder;
    }
}