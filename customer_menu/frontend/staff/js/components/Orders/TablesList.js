export class TablesList extends HTMLElement{
    constructor(){
        super();
        this.tables = {};
        this.showTables = {};
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
    }

    connectedCallback(){
        this.populateTables();
        setInterval(async()=>{
            this.populateTables();
        }, 10000);
    }

    populateTables(){
        fetch('../../backend/api/Orders.php?get_tables')
            .then(res=>res.json())
            .then(res=>{
                for(const i in res){
                    if(!(res[i].tableID in this.tables)){
                        this.tables[res[i].tableID] = res[i];
                        this.innerHTML += `<table-component table-id=${res[i].tableID} ></table-component>`;
                    }
                }
                console.log(this.tables);

            })
            .catch(err=>console.error(err));
    }

    populateAfterDelete(){
        fetch('../../backend/api/Orders.php?get_tables')
        .then(res=>res.json())
        .then(res=>{
            console.log(this.showTables);
            this.tables = {};
            for(const i in res){
                this.tables[res[i].tableID] = res[i];
            }
            this.render();
            console.log(this.tables);
        })
        .catch(err=>console.error(err));
        
    }

    render(){
        console.log('rendered');
        let placeholder = ``;
        Object.keys(this.tables).forEach(key=>{
            placeholder += `
                <table-component table-id=${key} ></table-component>
            `;
        })

        this.innerHTML = placeholder;
    }
}