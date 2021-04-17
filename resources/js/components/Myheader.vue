<template>
  <div>
    Myheader
    {{ name }}
    <ul>
      <li v-for="(language, index) in languages" :key="index">
        {{ language }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      name: "Nagwa",
    };
  },
  props: ["languages"],
};
</script>
