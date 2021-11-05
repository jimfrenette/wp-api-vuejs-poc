# wp-api-vuejs-poc
Proof of concept WordPress plugin to submit posts from the front end using the WordPress REST API and Vue.js

[http://jimfrenette.com/2017/01/post-from-front-end-wp-api-vuejs-part2/](http://jimfrenette.com/2017/01/post-from-front-end-wp-api-vuejs-part2/)

https://www.youtube.com/watch?v=aRHX-Xpy67E&t

<br />

## API Request Handlers

Three different web request handler examples are included:

### jquery

The [jquery-p02 tag](https://github.com/jimfrenette/wp-api-vuejs-poc/tree/jquery-p02) contains the following additions:

* List posts submitted by the current user
* Select from the list to edit a post
* Delete a post from the list

The [jquery-p01 tag](https://github.com/jimfrenette/wp-api-vuejs-poc/tree/jquery-p01) was cut from master and updated to replace vue-resource with the ajax method available in the external jQuery library loaded by default in WordPress.

### axios

The [axios-p01 tag](https://github.com/jimfrenette/wp-api-vuejs-poc/tree/axios-p01) was cut from master and updated with axios and vue-axios to replace vue-resource.

### vue-resource

The [vue-resource-p01 tag](https://github.com/jimfrenette/wp-api-vuejs-poc/tree/vue-resource-p01) was the initial version, created in master using the vue-resource plugin for Vue.js to provide services for making web requests and handle responses using a XMLHttpRequest.

<br />
<br />

## webpack

### Build Setup

``` bash
# install dependencies
npm install

# build for production with minification
npm run build
```

For detailed explanation on how things work, consult the [docs for vue-loader](http://vuejs.github.io/vue-loader).
