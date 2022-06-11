<template>
  <div id="app">
    <div id="nav">
      <Navbar />
    </div>
    <div id="ScrollToTop">
      <ScrollToTop />
    </div>
    
    <router-view/>
  </div>
</template>

<style>
html, body {
  margin: 0;
  background-color: #cc6067;
  font-family: sans-serif;
}
</style>

<script>
// @ is an alias to /src
import Navbar from '@/components/Navbar.vue'
import ScrollToTop from '@/components/ScrollToTop.vue'

export default {
  name: 'Nav',
  components: {
    Navbar,
    ScrollToTop
  }
}
</script>