<template>


    <div>

        <input type="hidden" name="user_id" v-model="id">
        <input type="text"
        :class="['form-control my-2', errors.content ? 'is-invalid' : '']"
         name="content" v-model="content">
<span v-if="errors.content" class="bg-danger text-white p-1 rounded">{{
              errors.content[0]
            }}</span>
        <button class="button" type="button" style="background-color:green;" @click="updatePost()">Edit</button>

    </div>


</template>
<script>

export default {
    components:{

    },
props:['post'],

  data: function () {
    return {
        content:this.post.content,
        id:this.post.id,
        errors:[]
       
    };
  },
  methods:{
      
      updatePost(){
         
          axios.put('api/post/' + this.id , {
              content : this.content,
          }).then((response) => {
              if(response.data.success){
                  this.$emit('itemUpdated');
                  Toast.fire({
            icon: "success",
            title: "Post Updated successfully",
          });
          this.errors = [];
                console.log('updated');
              } else {
                  this.errors = response.data.errors;
              }
            });
      }
      ,
      
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