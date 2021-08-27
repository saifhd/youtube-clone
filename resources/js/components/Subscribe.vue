<template>
     <div>
         <button class="btn btn-danger" @click="subscribe" v-if=" !subscribed ">Subscribe {{total_subscribes}}</button>
         <button class="btn btn-danger" @click="unsubscribe" v-if=" subscribed ">UnSubscribe {{total_subscribes}}</button>
         <div class="alert-danger mt-2 p-2" v-if="err_message">{{err_message}}</div>
     </div>
</template>
<script>
export default {
    props:{
        channel:{
            type:Object,
            required:true,
            default:()=>[]
        },

    },
    data(){
        return{
            auth_user:window.AuthUser,
            subscribed:false,
            total_subscribes:0,
            err_message:null
        }
    },
    methods:{
        async subscribe(){
            if(this.auth_user){
                const data={
                    channel_id:this.channel.id,
                }
                await axios.post('/subscriptions',data)
                this.total_subscribes=this.total_subscribes+1
                this.subscribed=true
            }
            else{
                this.err_message="Please Login for Subscribe"
            }
        },
        async unsubscribe(){
            if(this.auth_user){
                await axios.delete('/subscriptions/'+this.channel.id)
                this.total_subscribes=this.total_subscribes-1
                this.subscribed=false
            }
        }
    },
    mounted(){
        if(this.auth_user){
            axios.get('/subscriptions/'+this.channel.id+'/is-subscribed')
            .then(res=>{
                if(res.data.count == 1){
                    this.subscribed=true
                }
                this.total_subscribes=res.data.subscriptions
            });
        }

    }

}
</script>
