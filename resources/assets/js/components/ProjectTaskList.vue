<template>
    <div class="row">
        <div class="col-md-8">
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
        </div>
        <div class="col-md-4">
            <h4>active participants</h4>
            
            <ul>
                <li v-for="participant in participants" v-text="participant.name"> </li>
            </ul>
        </div>
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
                participants:[],
            }
        },
        computed: {
            channel() {
                //return window.Echo.private('tasks.'+this.project.id);
                return window.Echo.join('tasks.'+this.project.id);
            }
        },
        created(){
            axios.get(`/api/projects/${this.project.id}`)
                .then((response)=>{
                    console.log(response);
                    //this.project.tasks = response.data;
                });

            this.channel
                .here(user=>{
                    this.participants=user;
                    console.log('here');                    
                    console.log(user);
                })
                .joining(user=>{
                    this.participants.push(user);
                    console.log('joining');                    
                    console.log(user);
                }).leaving(user=>{
                    
                    this.participants.splice(this.participants.indexOf(user),1);
                    console.log('leaving');
                    
                    console.log(user);
                })
                .listen('TaskCreated',({task})=>{
                    //console.log(e);
                    this.project.tasks.push(task);
                })
                .listenForWhisper('typing',this.flashActivePeer);


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
