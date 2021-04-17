<template>


    <div>

        <a :href="href(post.id)">  
        {{ post.content }} 
        </a>
        <!-- Button trigger modal -->
        <Edit v-if="edit" :post="post" v-on:itemUpdated="updated()"></Edit>
         <button v-if="!edit"  class="button" type="button" style="background-color:green;" @click="activeEdit()">Edit</button>
         <button class="button" type="button" @click="deletePost()">Delete</button>
     
   <div>
  
</div>

    </div>


</template>
<script>
import Edit from './edit';
export default {
    components:{
        Edit

    },
props:['post' , 'user'],

  data: function () {
    return {
        edit:false,
    }
  },
  methods:{
     
      deletePost(){
        axios.delete('api/post/' + this.post.id).then((response) => {
            if(response.data.success){
console.log('Deleted');
                 this.$emit('itemDeleted');
                 Toast.fire({
            icon: "success",
            title: "Post Deleted successfully",
          });
            } else {
                Toast.fire({
            icon: "error",
            title: "Post Not Found",});
            }
                
            });
      },
      updated(){
          this.edit = false;
          this.$emit('itemChanged');
      },
      activeEdit(){
          this.edit = true;
      }, href (id) {
    return  '../post/show/' + id;
  }
      
  },
};
</script>


<style scoped>

.button{
  border:0;
  background: red;
  color:white; 
  border-radius: 25px;
}

</style>