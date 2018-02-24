<template>
    <div>
        <h2 v-text="project.name + ' Family'"></h2>
        <ul class="list-group">
            <li class="list-group-item" v-for="task in project.tasks" v-text="task.body"></li>
        </ul>
        <div class="form-group">
            <input class="form-control" type="text" v-model="newTask" @blur="save" @keydown="tapPeers">
        </div>

        <span v-if="activePeer" v-text="activePeer.name+' is Typing...'"></span>
    </div>
</template>

<script>
    export default {
        props: [ 'dataProject'],
        data() {
            return {
                project: this.dataProject,
                newTask:'',
                activePeer:false,
                typingTimer:false,
            }
        },
        computed: {
            channel() {
                return window.Echo.private('tasks.'+this.project.id);
            }
        },
        created(){
            axios.get(`/api/projects/${this.project.id}`)
                .then((response)=>{
                    console.log(response);
                    //this.project.tasks = response.data;
                });
            this.channel.listen('TaskCreated',({task})=>{
                //console.log(e);
                this.project.tasks.push(task);
            }).listenForWhisper('typing',this.flashActivePeer);


        },

        methods:{
            save(){
                axios.post(`/api/projects/${this.project.id}/tasks`,{body:this.newTask} )
                    .then(response=>response.data)
                    .then(this.addTask);
            },

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
            addTask(task){

                this.typingTimer=false;
                this.project.tasks.push(task);
                this.newTask = '';

            },
            tapPeers(){
                this.channel.whisper('typing',{
                    name:window.App.user.name,
                })
            }

        }

    }
</script>
