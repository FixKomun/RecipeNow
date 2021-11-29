<template>
  <div>
    <router-view :key="$route.path"></router-view>
  </div>
</template>

<script>
export default {
  props: ["user"],
  created() {
    console.log(this.user);
    this.$store.commit("setUserLoginStatus", this.user);
  }
};
</script>

<style lang="scss">
</style>
