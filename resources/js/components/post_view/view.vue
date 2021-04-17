<template>
  <div class="container">
    <h1>{{ post.user.name }} posted</h1>
    {{ post.updated_at }}

    <hr />
    <p class="lead">
      {{ post.content }}
    </p>
    <hr />

    <h3>Comments:</h3>
    <div style="margin-bottom: 50px">
      <textarea
        class="form-control"
        rows="3"
        name="content"
        v-model="new_comment"
        placeholder="Leave a comment"
      ></textarea>
      <button
        class="btn btn-success"
        style="margin-top: 10px"
        @click="addComment()"
      >
        Save Comment
      </button>
    </div>

    <div
      class="media"
      style="margin-top: 20px"
      v-for="(comment, index) in comments"
      :key="index"
    >
<div class="media-left">
      <a href="#">
        <img
          class="media-object"
          src="https://cdn1.iconfinder.com/data/icons/avatar-97/32/avatar-02-512.png"
          width="50"
          height="50"
          style="margin: 10px"
          alt="..."
        />
      </a>
    </div>
    <div class="media-body">
      <h4 class="media-heading">User said...</h4>
      <p>
        {{ comment.content }}
      </p>
      <span style="color: #aaa">on {{ comment.created_at }} </span>
    </div>
    </div>
  </div>
</template>


<script>
import Comment from './comment'

export default {
    components:{
        Comment
    },
  data: function () {
    return {
      new_comment: "",
      comments: "",
      current_user: "",
    };
  },
  props: ["post","auth_user_id"],
  mounted(){
      this.listen();
  },
  methods: {

    user() {
      axios.get("../../api/getUser/" + this.post.user_id).then((response) => {
        this.current_user = response.data.user;
      });
    },

    getComments() {
      axios.get("../../api/comments/" + this.post.id).then((response) => {
        this.comments = response.data.comments;
      });
    },

    addComment() {
      axios
        .post("../../api/comment/store", {
          content: this.new_comment,
          post_id: this.post.id,
          user_id: this.auth_user_id,
        }).then((response) => {
          this.new_comment = "";
          // this.$emit('commentAdded');
console.log(this.post.id);
          this.getComments();
        });
    },
    listen(){
        Echo.channel('post.'+this.post.id)
        .listen('NewComment' , (comment)=>{
            console.log(comment);
             Toast.fire({
            icon: "success",
            title: "New Comment",
          });
         //  this.comments.unshift(comment);
            this.getComments();
        });
    }
  },
  created() {
    this.user();
    this.getComments();
  },
};
</script>
