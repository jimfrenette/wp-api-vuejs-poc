<template>
  <div>
    <h3>Submit New Post</h3>
    <form v-on:submit.prevent="onSubmit">
      <div>
        <label>Title</label>
        <input type="text" v-model="post_title" required aria-required="true">
      </div>
      <div>
        <label>Content</label>
        <textarea rows="8" cols="20" v-model="post_content"></textarea>
      </div>
      <input type="submit" value="Submit">
    </form>
  <div>
</template>

<script>
import Vue from './main.js'

export default {
  data() {
      return {
          post_title: null,
          post_content: null
      }
  },
  methods: {
    onSubmit: function () {
      Vue.axios.post(
          wp_api_vuejs_poc.rest_url + 'wp/v2/posts',
          {
            title: this.post_title,
            content: this.post_content
          }
      ).then(response => {
        console.log( response );
        alert( wp_api_vuejs_poc.success );
      }, response => {
        console.log( response );
        alert( wp_api_vuejs_poc.failure );
      })
    }
  },
}
</script>
