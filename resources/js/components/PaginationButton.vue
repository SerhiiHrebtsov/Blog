<template>
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
    @click.prevent="onClick"
  />
</template>

<script>
export default {
  name: 'PaginationButton',

  props: {
    link: {
      type: Object,
      required: true,
    },
  },

  methods: {
    getPageFromUrl (url) {
      return url.slice(-1);
    },

    onClick () {
      this.$emit('clicked', this.getPageFromUrl(this.link.url))
    },
  },
};
</script>