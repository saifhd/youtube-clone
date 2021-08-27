<template>
    <div class="col-md-8">
        <div class="card" v-if="!selected">
            <div class="text-center">
                <input multiple type="file" id='video-files' ref="videos" style="display:none;" @change="upload">
                <i onclick="document.getElementById('video-files').click()" class="fab fa-youtube fa-6x mt-3" style="color: red;cursor:pointer;"></i>
                <p>Click Icon for Upload Video</p>
            </div>
        </div>
        <div v-for='video in videos' :key="video.name">
            <div class="card p-3" v-if='selected'>
                <div class="progress mb-3">
                    <div class="progress-bar progress-bar-striped progresss-bar-animated" role="progressbar" :style="{width:`${video.percentage || progress[video.name]}%`}"
                    area-valuenow="50" area-valuemin="0" area-valuemax="100">
                        <div v-if="video.percentage">
                            <div v-if="video.percentage==100">
                                Process Completed
                            </div>
                            <div v-else>
                                Processing
                            </div>
                        </div>
                        <div v-else>
                            Uploading
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div v-if="!video.thumbnail" class="d-flex justify-content-center alighn-item-center" style="height:180px;color:white;font-size:18px;background:#808080">
                            Loading Thumbnail...
                        </div>
                        <!-- <div v-if="video.thumbnail">{{ url }}</div> -->
                        <img v-else :src="url+'/storage/'+video.thumbnail" style="width:100%" alt="">
                    </div>
                    <div class="col-md-4">
                        <a :href="`${url}/videos/${video.id}`" target="_blank" v-if="video.percentage && video.percentage==100">
                            {{ video.title }}
                        </a>
                        <div v-else class="text-center">
                            <h5 class="mt-5">{{video.title || video.name}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props:
        {
            channel:{
                type:Object,
                required:true,
                default:()=>[]
             },
           url:{
                type:String,
                required:true,
                default:()=>""
            }
        },
        data(){
            return{
                selected:false,
                videos:[],
                progress:{},
                uploads:[],
                intervals:{}
            }
        },
        methods:{
            upload(){
                this.selected=true
                this.videos=Array.from(this.$refs.videos.files)

                const uploader=this.videos.map(video=>{
                    const Form=new FormData()
                    Form.append('video',video)
                    Form.append('title',video.name)
                    this.progress[video.name]=0
                    return axios.post('/channels/'+this.channel.id+'/upload',Form,{
                        onUploadProgress:(event)=>{
                            this.progress[video.name]=Math.ceil((event.loaded/event.total)*100)
                            this.$forceUpdate(this.progress[video.name])

                        }
                    }).then((data)=>{
                        // console.log(data.data)
                        this.uploads=[
                            ...this.uploads,
                            data.data
                        ]

                    })
                })
                // console.log(this.videos[0])

                axios.all(uploader).then(()=>{
                    this.videos=this.uploads
                    // console.log(this.videos)
                    this.videos.forEach((video)=>{
                        console.log(video)
                        this.intervals[video.id]=setInterval(()=>{
                            axios.get('/videos/'+video.id).then((data)=>{
                                // console.log(video.id)
                                if(data.data.percentage==100){
                                    clearInterval(this.intervals[video.id])
                                }
                                this.videos=this.videos.map((v)=>{
                                    if(v.id == data.data.id){
                                        return data.data
                                    }
                                    return v;
                                })
                            })
                        },3000)
                    })
                })
            }
        },

    }
</script>
