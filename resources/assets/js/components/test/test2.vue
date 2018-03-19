<template>
    <div>
        I am vue compoment

        <button class="btn btn-success" @click="fire">click me</button>
    </div>
</template>

<script>
    export default {
        methods: {
            fire() {
                console.log('I am on fire');
            }
        },
    }
</script>

<style scoped>

</style>