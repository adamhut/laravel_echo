<template>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <i class="fa fa-bell"></i>
            <span class="notification-count label label-danger" v-text="notifications.length"></span>
            <span class="caret"></span>
        </a>

        <ul class="dropdown-menu dropdown-menu-notifications" role="menu">
            <li v-for="notification in notifications">
                <a :href="notification.url">
                    <div>
                        <i class="fa fa-exclamation-circle fa-fw"></i> {{notification.description}}
                        <span class="pull-right text-muted small">
                                <timeago :since="notification.time" :auto-update="60">
                                </timeago>
                        </span>
                    </div>
                </a>
                <div class="divider"></div>
            </li>

            <li>
                <div class="text-center see-all-notifications">
                    <a href="/orders" v-if="notifications.length">
                        <strong>See All Orders</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                    <div v-else>
                        No Notifications
                    </div>
                </div>
            </li>
        </ul>
    </li>
</template>

<script>
    import VueTimeago from 'vue-timeago'

    Vue.use(VueTimeago, {
    name: 'timeago', // component name, `timeago` by default
    locale: 'en-US',
    locales: {
        // you will need json-loader in webpack 1
        'en-US': require('vue-timeago/locales/en-US.json')
    }
    })

    export default {

        data() {
            return {
                notifications: [],
            }
        },
        mounted(){
            Echo.channel('pizza-tracker')
            .listen('OrderStatusChanged',e =>{
                if(App.user.id ==e.order.user_id)
                {
                   this.notifications.unshift({
                       description : 'Order ID: '+e.order.id+' updated',
                       url: '/orders/'+e.order.id,
                       time:new Date(),
                   });
                }
            });
        },
    }
</script>

<style scoped>

</style>