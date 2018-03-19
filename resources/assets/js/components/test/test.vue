<template>
    <div>
        I am a test component
        <component :is="dynamicComponent"></component>

        <button class="btn btn-success" @click="getComponent">Fire</button>
    </div>
</template>

<script>
    import test2 from './test2.vue';
    export default {
        data() {
            return {
                dynamicComponent: null,
            }
        },
        components:{
            test2,
        },

        methods: {
            getComponent() {
                axios.get('/load-component')
                    .then(response=>{
                        this.dynamicComponent =response.data.component;

                        console.log(response.data);
                    })

            }
        },
    }
</script>

<style scoped>

</style>