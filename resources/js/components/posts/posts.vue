<template>


    <div class="posts-container">

<p>
        Posts
        </p>
       
        <Postadd :user="user" v-on:itemAdded="getPosts()" ></Postadd>
    
    <ul style="padding:20px">
      <li style="padding:10px" v-for="(post, index) in posts" :key="index">
        <Post :post="post" :user="user" v-on:itemDeleted="getPosts()"  v-on:itemChanged="getPosts()"></Post>
      </li>
    </ul>

    </div>


</template>
<script>

import Postadd from './add';
import Post from './item';

export default {
    components:{
Postadd,Post
    },
  data: function () {
    return {
      posts:[],
    };
  },
props:['user'],
  methods:{
      getPosts(){
          axios.get('api/posts').then((response) => {
        this.posts = response.data.posts;
      });
      },
     
  }, 
created() {
    this.getPosts();
  },
};
</script>

<style scoped>

.posts-container{
    margin:auto;
    background-color:#030d37;
    color:white;
    display:flex;
    justify-content:center;
    width:100%;
    align-content:center;
    flex-direction: column;
    align-items:center;
    padding:20px;
    border: 2px solid ;
  border-radius: 25px;

}


</style>