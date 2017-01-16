<template>
  <div>

    <h3>{{ heading }}</h3>
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
      <span v-if="post_id">
        <a href="#" @click="newPost">New Post</a>
      </span>
    </form>

    <div v-if="loading">
      Loading...
    </div>

    <div v-if="error">
      {{ error }}
    </div>

    <div v-if="posts">
      <ul>
          <li v-for="post in posts">
            <a href="#" @click='editPost(post)'>{{ post.title.rendered }}</a>
            <a href="#" @click='delPost(post)' title="DELETE">[&ndash;]</a>
          </li>
      </ul>
    </div>

  <div>
</template>

<script>
import $ from 'jquery'
import Vue from './main.js'

export default {
  data() {
    return {
      error: null,
      heading: 'Submit New Post',
      loading: null,
      post_id: null,
      post_title: null,
      post_content: null,
      posts: null
    }
  },
  methods: {
    editPost( post ) {
      this.heading = 'Edit Post'
      this.post_id = post.id
      this.post_title = post.title.rendered
      this.post_content = post.content.rendered
    },
    delPost( post ) {
      $.ajax({
        method: "DELETE",
        url: wp_api_vuejs_poc.rest_url + 'wp/v2/posts/' + post.id,
        beforeSend: function ( xhr ) {
          xhr.setRequestHeader( 'X-WP-Nonce', wp_api_vuejs_poc.nonce );
        }
      })
      .done( $.proxy( function() {
        this.getPosts();
      }, this ))
      .fail( $.proxy( function( response ) {
        console.log( response );
      }, this ));
    },
    getPosts () {
      this.error = this.posts = null
      this.loading = true
      var params = '?author='+ wp_api_vuejs_poc.current_user_id +'&status=any';

      $.ajax({
        url: wp_api_vuejs_poc.rest_url + 'wp/v2/posts' + params,
        beforeSend: function ( xhr ) {
          xhr.setRequestHeader( 'X-WP-Nonce', wp_api_vuejs_poc.nonce );
        }
      })
      .done( $.proxy( function( response ) {
          this.loading = false;
          this.posts = response;
          this.newPost();
      }, this ))
      .fail( $.proxy( function( response ) {
          this.error = response;
      }, this ));
    },
    newPost() {
      this.heading = 'Submit New Post'
      this.post_id = null
      this.post_title = null
      this.post_content = null
    },
    onSubmit: function () {
      var route = 'wp/v2/posts'
      if (this.post_id != null) {
        route = route + '/' + this.post_id
      }

      $.ajax({
        method: "POST",
        url: wp_api_vuejs_poc.rest_url + route,
        data: {
          title: this.post_title,
          content: this.post_content
        },
        beforeSend: function ( xhr ) {
          xhr.setRequestHeader( 'X-WP-Nonce', wp_api_vuejs_poc.nonce );
        }
      })
      .done( $.proxy( function( response ) {
        console.log( response );
        alert( wp_api_vuejs_poc.success );
        this.getPosts ();
      }, this ))
      .fail( $.proxy( function( response ) {
        console.log( response );
        alert( wp_api_vuejs_poc.failure );
      }, this ));
    }
  },
  mounted: function () {
    this.$nextTick(function () {
      this.getPosts ();
    })
  }
}
</script>
