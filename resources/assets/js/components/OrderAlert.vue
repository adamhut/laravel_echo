<template>
    <div>

        <alert v-model="showRight" placement="top-right" duration="3000" type="success" width="400px" dismissable>
            <span class="icon-ok-circled alert-icon-float-left"></span>
            <strong>Order Status Updated!</strong>
            <p>Order Id:{{orderId}} has been updated</p>
        </alert>
    </div>
</template>

<script>
    import {alert} from 'vue-strap'
    export default {

        data(){
            return {
                showRight:false,
                orderId:'',
            }
        },
        components:{
            alert,
        },

        mounted(){
            Echo.channel('pizza-tracker')
            .listen('OrderStatusChanged',e =>{
                this.showRight=true;
                this.orderId = e.order.id;
            });
        },
    }
</script>

<style scoped>

</style>