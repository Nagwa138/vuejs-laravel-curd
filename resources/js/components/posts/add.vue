
<template>

    <div>
    

        <input type="hidden" name="user_id" v-model="user.id">
        <input type="text" 
        :class="['form-control my-2', errors.content ? 'is-invalid' : '']"
         name="content" v-model="content" placeholder="Type ...">
<span v-if="errors.content" class="bg-danger text-white p-1 rounded">{{
              errors.content[0]
            }}</span>
        <button type="button" @click="addPost">
            Add
        </button>


    </div>


</template>

<script>
export default {
  data: function () {
    return {
      content:'',
      post:'',
      errors:[]

    };
  },
  props:['user'],
  methods:{
      addPost(){

        if(this.content == ""){
         Toast.fire({
            icon: "error",
            title: "Please enter your post !",
          });
        } else {

          axios.post('api/post/store' , {
              user_id:this.user.id,
              content:this.content
          }).then(response=>{
              if(response.data.success){
this.post = response.data.post;
                  this.content="";
                  this.$emit('itemAdded');
                  Toast.fire({
            icon: "success",
            title: "Post Added successfully",
          });
          this.errors = [];
              } else {
                 this.errors = response.data.errors;
              }
                  
             
          }).catch(error=>{
            console.log(error);
          });
        }
      }
  }
};
</script>

<style scoped>

button{
  border:0;
  border-raduis: 20px blue;
  background: #1ecbe1;
  color:white; 
}

</style>