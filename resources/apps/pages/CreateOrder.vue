<template>
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{this.pageTitle}} {{this.totalMakanan}}</h3>

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
            
            <div class="form-group row" v-for="(input,k) in form" :key="k">
                <!--<input type="text" class="form-control" v-model="input.name">-->
                <div class="col-sm-4">
                    <model-select 
                    :options="optionsSelect"
                    v-model="input.name"
                    @input="onSelect($event)"
                    ref="createOrder"
                    ></model-select>
                </div>
                <div class="col-sm-1">
                    <input 
                    type="text" 
                    class="form-control" 
                    v-model="input.qty"
                    >
                </div>
                <div class="col-sm-2">
                    <input 
                    type="text" 
                    class="form-control" 
                    :value="myPrice(input.name,input.qty)"
                    >
                </div>
                <div class="col-sm-2">
                    <i class="fas fa-minus-circle" @click="remove(k)" v-show="k || ( !k && form.length > 1)"></i>
                    <i class="fas fa-plus-circle" @click="add(k)" v-show="k == form.length-1"></i>
                </div>
            </div>


        <!-- end input form -->    
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Footer
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
            form: [{
                
                name: '',
                qty:'',
                price:'',
            }],
            optionsSelect: [],
            menuPrice:[],
            totalMakanan:''
        }
    },
    methods: {
        add(index) {
            this.form.push({ name: '' });
        },
        remove(index) {
            this.form.splice(index, 1);
        },
        getMenu(){
            
            axios.get('/api/v1/menus?select=makanan')
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
            console.log('input.name '+this.form[0].qty)

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
            console.log(JSON.stringify(this.form))

            const options = this.form.map(item => {

                const container = {}

                if (item.name) {

                    var price = this.getPrice(item.name)
                    container.price = price * item.qty

                }else{

                    container.price = ''
                }

                return container
            })

            console.log('total :',JSON.stringify(options))

            this.totalMakanan = options.reduce(function(sum, current) {
                                    return sum + current.price;
                                }, 0);
        }
    },
    mounted(){

        this.getMenu()
        this.getTotalMakanan()
        
       
        
    }
}


</script>