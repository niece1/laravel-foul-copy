<template>
  <div class="container">
    <h2>Posts</h2>

    <form @submit.prevent="addPost" class="mb-3">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Title" v-model="post.title">
      </div>
      <div class="form-group">
        <textarea class="form-control" placeholder="Content" v-model="post.content"></textarea>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Save</button>
    </form>
    
    <button @click="clearForm()" class="btn btn-danger btn-block">Cancel</button>
    
    <div class="card card-body mb-2" v-for="post in posts" v-bind:key="post.id">
      <h3>{{ post.title }}</h3>
      <p>{{ post.content }}</p>
      <hr>
      <button @click="editPost(post)" class="btn btn-warning mb-2">Edit</button>
      <button @click="deletePost(post.id)" class="btn btn-danger">Delete</button>
    </div>

    <nav aria-label="Page navigation example">
      <ul class="pagination mt-3">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchPosts(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchPosts(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>

  </div>
</template>

<script>
export default {
  data() {
    return {
      posts: [],
      post: {
        id: '',
        title: '',
        content: ''
      },
      post_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchPosts();
  },
  methods: {
    fetchPosts(page_url) {
      let vm = this;
      page_url = page_url || '/api/posts';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.posts = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
      this.pagination = pagination;
    },
    deletePost(id) {
      if (confirm('Are You Sure?')) {
        fetch(`api/post/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('Post Removed');
            this.fetchPosts();
          })
          .catch(err => console.log(err));
      }
    },
    addPost() {
      if (this.edit === false) {
        // Add
        fetch('api/post', {
          method: 'post',
          body: JSON.stringify(this.post),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Post Added');
            this.fetchPosts();
          })
          .catch(err => console.log(err));
      } else {
        // Update
        fetch('api/post', {
          method: 'put',
          body: JSON.stringify(this.post),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Post Updated');
            this.fetchPosts();
          })
          .catch(err => console.log(err));
      }
    },
    editPost(post) {
      this.edit = true;
      this.post.id = post.id;
      this.post.post_id = post.id;
      this.post.title = post.title;
      this.post.content = post.content;
    },
    clearForm() {
      this.edit = false;
      this.post.id = null;
      this.post.post_id = null;
      this.post.title = '';
      this.post.content = '';
    }
  }
};
</script>