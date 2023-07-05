<template>
  <Head title="Dashboard"/>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Post
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div className="flex items-center justify-between mb-6">
            <Link
              className="px-6 py-2 text-white bg-blue-500 rounded-md focus:outline-none"
              :href="route('posts.index')"
            >
              Back
            </Link>
            <div>
              <p class="text-gray-500 font-bold text-sm">{{ post.user.name }}</p>
              <p class="text-gray-400 text-xs">{{ $filters.timeAgo(post.created_at) }}</p>
            </div>
          </div>
          <h3 class="font-bold mb-4 text-xl">{{ post.title }}</h3>
          <p class="mb-6">{{ post.content }}</p>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

export default {
  name: 'PostShow',

  components: {
    AuthenticatedLayout,
    GuestLayout,
    Head,
    Link,
  },

  props: {
    post: {
      type: Object,
      required: true,
    },
  },
};
</script>