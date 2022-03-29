export class OrdersLists extends HTMLElement{
    constructor(){
        super();
        this.tables;
        this.showTable = [];
    }

    static get observedAttributes(){
        return ["show-table"];
    }

    attributeChangedCallback(prop, oldVal, newVal){
        if(prop == "show-table"){
            if(typeof this.showTable[newVal] === 'undefined'){
                this.showTable[newVal] = true;
            }else{
                delete this.showTable[newVal];
            }
            
        }
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
        console.log(this.tables);
        let placeholder = ``;
        for(const index in this.tables){
            console.log(this.tables[index].tableID);

            placeholder += `
                <orders-component table-id=${this.tables[index].tableID} index="${index}" show="${this.showTable[index]}"></orders-component>
            `;
        }

        this.innerHTML = placeholder;
    }
}