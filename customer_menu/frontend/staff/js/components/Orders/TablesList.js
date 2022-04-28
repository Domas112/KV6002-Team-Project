export class TablesList extends HTMLElement{
    constructor(){
        super();
        this.tables = {};
        this.showTables = {};
        this.hasOrders = false;
        this.needsClearing = true;

        this.noOrdersTemplate = `
            <h1 class='text-center'>No orders placed</h1>
        `;
    }
    get deleted(){return this.getAttribute('deleted');}
    set deleted(val){this.setAttribute('deleted',val);}

    static get observedAttributes(){
        return ['deleted', 'show-table'];
    }

    attributeChangedCallback(prop, oldVal, newVal){
        if(prop == 'deleted'){
            if(newVal == 'true'){
                this.populateAfterDelete();
                this.deleted = 'false';
            }
        }
        if(prop == 'show-table'){
            this.showTables[newVal] = !this.showTables[newVal];
        }
    }

    connectedCallback(){
        this.populateTables();
        setInterval(async()=>{
            this.populateTables();
        }, 10000);
    }


    //Populating the tables and rendering children components with the relevant information.
    //NOTE: instead of rerendering the view, additional, new tables are instead appended to the existing innerHTML
    //so the view would not twitch with every populate attempt.
    populateTables(){
        fetch('../../backend/api/Orders.php?get_tables')
            .then(res=>res.json())
            .then(res=>{
                if(this.needsClearing){
                    this.innerHTML = '';
                }

                if(Object.keys(res).length > 0){
                    for(const i in res){
                        if(!(res[i].tableID in this.tables)){
                            this.tables[res[i].tableID] = res[i];
                            this.showTables[res[i].tableID] = false;
                            this.innerHTML += `<table-component table-id=${res[i].tableID} show=${this.showTables[res[i].tableID]} vip=${res[i].VIP}></table-component>`;
                        }
                    }
                }

                if(Object.keys(this.tables).length > 0){
                    this.hasOrders = true;
                    this.needsClearing = false;
                }

                if(!this.hasOrders){
                    this.innerHTML = this.noOrdersTemplate;
                }

                this.hasOrders = false;
            })
            .catch(err=>console.error(err));
    }

    //If a table of orders was deleted, the whole list of active tables has to be retrieved once again
    //and the view has to be rerendered. It is important to rerender all the tables with the same viewing
    //states as they were before deleting the table of orders.
    populateAfterDelete(){
        
        fetch('../../backend/api/Orders.php?get_tables')
        .then(res=>res.json())
        .then(res=>{
            
            this.tables = {};
            let newShowTables = {};
            this.hasOrders = false;

            if(Object.keys(res).length > 0){
                for(const i in res){
                    this.tables[res[i].tableID] = res[i];
                    newShowTables[res[i].tableID] = this.showTables[res[i].tableID];
                }
                
                this.hasOrders = true;
            }

            this.showTables = newShowTables;

            if(!this.hasOrders){
                this.innerHTML = this.noOrdersTemplate;
                this.needsClearing = true;
            }else{
                this.render();
            }
        })
        .catch(err=>console.error(err));
        
    }

    render(){
        let placeholder = ``;
        Object.keys(this.tables).forEach(key=>{
            placeholder += `
                <table-component table-id=${key} show=${this.showTables[key]} vip=${this.tables[key].vip}></table-component>
            `;
        })

        this.innerHTML = placeholder;
    }
}