# wp-api-vuejs-poc
Proof of concept WordPress plugin to submit posts from the front end using the WordPress REST API and Vue.js

[http://jimfrenette.com/2017/01/post-from-front-end-wp-api-vuejs/](http://jimfrenette.com/2017/01/post-from-front-end-wp-api-vuejs/)

<br />
<br />

## API Request Handlers

Three different web request handler examples are included:

### vue-resource

The [master branch](https://github.com/jimfrenette/wp-api-vuejs-poc) was created initially using the vue-resource plugin for Vue.js to provide services for making web requests and handle responses using a XMLHttpRequest.

### axios

The [f-axios branch](https://github.com/jimfrenette/wp-api-vuejs-poc/tree/f-axios) was cut from master and updated with axios and vue-axios to replace vue-resource.

### jquery

The [f-jquery branch](https://github.com/jimfrenette/wp-api-vuejs-poc/tree/f-jquery) was cut from master and updated to replace vue-resource with the ajax method available in the external jQuery library loaded by default in WordPress.

<br />
<br />

## webpack

### Build Setup

``` bash
# install dependencies
npm install

# serve with hot reload at localhost:8080
npm run dev

# build for production with minification
npm run build
```

For detailed explanation on how things work, consult the [docs for vue-loader](http://vuejs.github.io/vue-loader).
