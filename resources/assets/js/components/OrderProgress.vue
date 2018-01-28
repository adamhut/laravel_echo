<template>
    <div>
        <div class="progress">
            <progressbar :now="progress" label="50%" type="success" striped animated></progressbar>
        </div>
        <div class="order-status">
            <strong>Order Status</strong> {{status}}
        </div>
        <img src="/img/deliver.gif" alt="Deliver" v-if="progress==100">
    </div>
</template>

<script>
    import {progressbar} from 'vue-strap'
    export default {
        props:[
            'order'
        ],
        components:{
            progressbar,
        },
        data(){
            return{
                id:this.order.id,
                status:this.order.status.name,
                progress:this.order.status.percent,
            };
        },
        mounted(){
            Echo.channel('pizza-tracker.'+this.id)
            .listen('OrderStatusChanged',e=>{
                this.progress= e.order.status.percent;
                this.status = e.order.status.name;
            });
        },

        computed: {
            percent() {
                return this.order.status.percent;
            },
        },
    }
</script>

<style scoped>

</style>