<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap mt-8">
      <template
        v-for="(link, key) in links"
        :key="key"
      >
        <div
          v-if="link.url === null"
          v-html="link.label"
          class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
        />
        <button
          v-else
          v-html="link.label"
          class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-primary focus:text-primary"
          :class="{ 'bg-blue-700 text-white': link.active }"
          @click.prevent="$emit('page-changed', getPageFromUrl(link.url))"

        />
      </template>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
  name: 'Pagination',

  components: {
    Link,
  },

  props: {
    links: Object,
    required: true,
  },

  methods: {
    getPageFromUrl (url) {
      return url.slice(-1);
    },
  },
};
</script>