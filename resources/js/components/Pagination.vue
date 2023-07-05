<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap mt-8">
      <PaginationButton
        v-for="(link, key) in links"
        :key="key"
        :link="link"
        @clicked="onClick"
      />
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import PaginationButton from '@/components/PaginationButton.vue';

export default {
  name: 'Pagination',

  components: {
    Link,
    PaginationButton,
  },

  props: {
    links: Object,
    required: true,
  },

  methods: {
    onClick(value) {
      this.$emit('page-changed', value);
    }
  }
};
</script>