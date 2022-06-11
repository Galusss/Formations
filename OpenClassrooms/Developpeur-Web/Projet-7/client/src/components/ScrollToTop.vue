<template>
  <div class="scrollToTop">
      <i class="angle double up icon" @click="scrollToTop()"></i>
  </div>
</template>


<style scoped>
i.icon{
    position: fixed;
    right: 0;
    bottom: 0;
    margin: 15px;
    color: rgb(14, 14, 14);
}
</style>


<script>
export default {
  name: 'ScrollToTop',
  props: {
    msg: String
  },
  methods: {
      scrollToTop() {
          window.scrollTo(0, 0);
      } 
  }
}
</script>
