<template>
    <div>
        <select @change="updateCart()" v-model="cart.value">

           <option v-for="number in cart" v-bind:value="number.value" :selected = "this.cart.value=this.status ? 'selected' : '' " >{{number.text}}</option>


       </select>
   </div>
</template>

<script>
    export default {
        props: ['dataId', 'old'],
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                
               
                cart:[ 
                { text:"one", value: 1 },
                { text:"two", value: 2 },
                { text:"three", value: 3 },
                ],
                status: this.old,
            }
        },
        methods: {
            updateCart() {
                axios.patch('/cart/'+ this.dataId,
                {
                    quantity: this.cart.value
                }   )
                .then(response=>{
                   /*   console.log(response.data);*/
                   window.location = '/cart';
               })
                .catch(error=> {

                    window.location = '/cart';
                });

            }
        },
        computed: {
            selectedItem(){
                return (this.cart.value=this.status);
            }
        }
    }
</script>
