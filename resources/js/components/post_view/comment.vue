<template>
  <div>
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
      <h4 class="media-heading"> said...</h4>
      <p>
        {{ comment.content }}
      </p>
      <span style="color: #aaa">on {{ comment.created_at }} </span>
    </div>
  </div>
</template>


<script>
export default {
  data: function () {
    return {
      comment: "",
    };
  },
  props: ["comment_id"],
  methods: {
    getComment() {
      axios
        .get("../../api/comment/getOwner/" + this.comment_id)
        .then((response) => {
          this.comment = response.data.comment;
        });
    },
  },
  created() {
    this.getComment();
  },
};
</script>
