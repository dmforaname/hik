<template>
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{this.pageTitle}}</h3>

            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
            </div>
        </div>
        <div class="card-body">
        <!-- input form -->
            
            <div class="form-row">
                <div class="col-sm-2">
                    <input 
                    type="number" 
                    class="form-control" 
                    v-model="form.table"
                    placeholder="Table Number"
                    min="0"
                    max="25"
                    >
                </div>
            </div>

            <div class="form-row" v-for="(input,k) in form.order" :key="k" style="padding-top:10px">
                <!--<input type="text" class="form-control" v-model="input.name">-->
                <div class="col-sm-4">
                    <model-select 
                    :options="optionsSelect"
                    v-model="input.menu_id"
                    @input="onSelect($event)"
                    ref="createOrder"
                    class="form-control" 
                    placeholder="Pilih Menu"
                    ></model-select>
                </div>
                <div class="col-sm-1">
                    
                    <input 
                    type="text" 
                    class="form-control" 
                    v-model="input.qty"
                    placeholder="Qty"
                    >
                </div>
                <div class="col-sm-2">
                    
                    <input 
                    type="text" 
                    class="form-control" 
                    :value="myPrice(input.menu_id,input.qty)"
                    readonly
                    >
                </div>
                <div class="col-sm-2">
                    
                    <input 
                    type="text" 
                    class="form-control" 
                    v-model="input.notes"
                    placeholder="Notes"
                    >
                </div>
                <div class="col-sm-1 s">

                    <i class="fas fa-minus-circle fa-2x" style="color:red" @click="remove(k)" v-show="k || ( !k && form.order.length > 1)"></i>
                    <i class="fas fa-plus-circle fa-2x" style="color:green" @click="add(k)" v-show="k == form.order.length-1"></i>
                </div>
                
            </div>
            <div class="form-row col-6" style="padding-top:10px">
                <button 
                type="button" 
                ref="submitButton"
                class="btn btn-primary btn-flat"
                @click="addData()"
                >Submit</button>
            </div>
            
        <!-- end input form -->    
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Total Rp. {{this.totalMakanan}} ,-
        </div>
        <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </div>
</template>

<script>

import { ModelSelect } from 'vue-search-select'

export default { 

    components: {

        ModelSelect,
    },
    data () {
        return {

            pageTitle : this.$route.meta.title,
            form:{
                table:'',
                order:[{
                    menu_id: '',
                    qty:'',
                    notes:'',
                }],
            },
            optionsSelect: [],
            menuPrice:[],
            totalMakanan:'',
        }
    },
    methods: {
        add(index) {
            console.log('add Index: '+index)
            this.form.order.push({ menu_id: '' });
        },
        remove(index) {
            this.form.order.splice(index, 1);
        },
        getMenu(){
            
            axios.get('/api/v1/menus?select=all')
                .then((response) => {
                    
                    const options = response.data.data.map(item => {

                        const container = {}

                        container.value = item.id
                        container.text = item.name
                        container.desc = item.price

                        return container
                    })

                    this.optionsSelect = options
                    

                })
                .catch( resonse => {
                    console.log('error');
                })
        },
        onSelect (e) {
            
            console.log('Select:',e)
            //console.log('input.name '+this.form[0].qty)

            //let select = this.optionsSelect
            //let item = select.find(el => el.value === e)
            //this.menuPrice[l] = item.desc
        },
        myPrice (price,qty)
        {
            if (qty && price) {

                var newPrice = this.getPrice(price)

                this.form.price = newPrice 
                this.getTotalMakanan()
                return newPrice * qty
            }
            else{

                return 0
            }
            
        },
        getPrice(price)
        {
            let select = this.optionsSelect
            let item = select.find(el => el.value === price)

            return item.desc 
        },
        getTotalMakanan()
        {
            const options = this.form.order.map(item => {

                const container = {}

                if (item.menu_id) {

                    var price = this.getPrice(item.menu_id)
                    container.price = price * item.qty

                }else{

                    container.price = ''
                }

                return container
            })

            //console.log('total :',JSON.stringify(options))

            this.totalMakanan = options.reduce(function(sum, current) {
                                    return sum + current.price;
                                }, 0);
        },
        addData() {

            console.log('add_data')

            axios.post('/api/v1/orders', {

                order : this.form.order,
                table : this.form.table,
                
                
            }).then(response => {
                
                this.$toastr.success(response.data.message)
                this.resetForm()
                    
            }).catch(err=>{

                var error = err.response.data.errors
                this.err.title = error.title[0]                  
            });
            
        },
        resetForm() {
            
            var self = this; 

            console.log(self)

            Object.keys(this.form).forEach(function(key,index) {
                self.form[key] = '';
                
            });

            self.form.order = [{
                    menu_id: '',
                    qty:'',
                    notes:'',
                }]
            self.totalMakanan = 0    
        },  
    },
    mounted(){

        this.getMenu()
        this.getTotalMakanan()
        
       
        
    }
}


</script>
<style>

.total-price {

    padding-top: 1%;
}
</style>