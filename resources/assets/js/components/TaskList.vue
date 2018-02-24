<template>
    <div>
        <ul>
            <li v-for"task in tasks" v-text="task"></li>
        </ul>
        <input type="text" v-model="newTask" @blur="addTask" @keydown="tapPeer">

        <span v-if="activePeer" v-text="activePeer.name+' is Typing'"></span>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tasks: [],
                newTask:'',
                activePeer:false,
                typingTimer:false,
            }
        },
        computed: {
            channel() {
                return window.Echo.private('tasks');
            }
        },
        created(){
            axios.get('/tasks')
                .then((response)=>{
                    this.tasks = response.data;
                });
            this.channel
                .listen('TaskCreated',({task})=>{
                    this.tasks.push(task.body);

                }).listenForWhisper('typeing',this.flashActivePeer);
                /* Echo.channel('tasks')
                .listen('TaskCreated',({task})=>{
                    this.tasks.push(task.body);
                })
                */

        },

        methods:{
            flashActivePeer(e){
                this.activePeer = e;
                if(this.typingTimer)
                {
                    clearTimeout(this.typingTimer);
                }
                this.typingTimer = setTimeout(()=>{
                    this.activePeer=false;
                },3000);
                    //alert('Somebody is typing');

            },
            addTask(){
                axios.post('/tasks',{body:this.newTask} )
                    .then((response)=>{
                        this.typingTimer=false;
                        this.tasks.push(this.newTask);
                        this.newTask = '';
                    });
            },
            tapPeer(){
                this.channel.whisper('typing',{
                        name:window.App.user.name,
                    })
            }

        }

    }
</script>

<style scoped>

</style>