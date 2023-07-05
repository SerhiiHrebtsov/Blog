<template>
  <Head title="Dashboard"/>
  <AuthenticatedLayout>
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Posts
        </h2>
        <Link
          className="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
          :href="route('posts.create')"
        >
          Create Post
        </Link>
      </div>

    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div
          v-if="posts.length"
          class="grid xl:grid-cols-3 md:grid-cols-2 gr gap-6"
        >
          <div
            v-for="post in posts"
            :key="post.id"
            class="bg-white overflow-hidden shadow-sm rounded-lg p-6 flex flex-col"
          >
            <h6 class="font-bold mb-4">{{ post.title }}</h6>
            <p class="mb-8 mt-auto">{{ $filters.truncate(post.content, 100) }}</p>

            <div class="flex items-center mt-auto mb-4">
              <Link
                tabIndex="1"
                className="px-4 py-2 mr-1 text-sm text-white bg-gray-500 rounded"
                :href="route('posts.show', post.id)"
              >
                Open
              </Link>
              <Link
                v-if="post.states.editable"
                tabIndex="1"
                className="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                :href="route('posts.edit', post.id)"
              >
                Edit
              </Link>
              <button
                v-if="post.states.deletable"
                @click="destroy(post.id)"
                tabIndex="-1"
                type="button"
                className="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
              >
                Delete
              </button>
            </div>
            <div>
              <p class="text-gray-500 font-bold text-sm">{{ post.user.name }}</p>
              <p class="text-gray-400 text-xs">{{ $filters.timeAgo(post.created_at) }}</p>
            </div>
          </div>
        </div>
        <p
          v-else
          class="font-bold text-gray-400 text-center text-xl"
        >
          No posts yet
        </p>
        <Pagination
          class="mt-6"
          :links="links"
          @pageChanged="loadPosts"
        />
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Pagination from '@/components/Pagination.vue';

export default {
  name: 'PostIndex',

  components: {
    AuthenticatedLayout,
    GuestLayout,
    Pagination,
    Head,
    Link,
  },

  data () {
    return {
      posts: [],
      links: [],
    };
  },

  methods: {
    loadPosts (page = 1) {
      this.$axios.get(`/posts/?page=${page}`).then(res => {
        const { data } = res.data;

        this.posts = data.data;
        this.links = data.meta.links;
      });
    },

    destroy (id) {
      if(confirm('Are you sure you want to Delete')) {
        this.$axios.delete(`/posts/${id}`).then(res => {
          this.loadPosts();
        });
      }
    },
  },

  beforeMount () {
    this.loadPosts();
  },
};
</script>