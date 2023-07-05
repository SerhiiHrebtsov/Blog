<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Post
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div className="flex items-center justify-between mb-6">
              <Link
                className="px-6 py-2 text-white bg-blue-500 rounded-md focus:outline-none"
                :href="route('posts.index')"
              >
                Back
              </Link>
            </div>
            <form name="createForm" @submit.prevent="submit">
              <div className="flex flex-col">
                <div className="mb-4">
                  <InputLabel for="title" value="Title" />

                  <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                  />
                  <span className="text-red-600" v-if="errors.title">
                      {{ errors.title }}
                  </span>
                </div>
                <div className="mb-4">
                  <InputLabel for="body" value="Content" />

                  <Textarea
                    id="body"
                    class="mt-1 block w-full"
                    rows="6"
                    v-model="form.content"
                  />
                  <span className="text-red-600" v-if="errors.content">
                      {{ errors.content }}
                  </span>
                </div>
              </div>

              <div className="mt-4">
                <button
                  type="submit"
                  className="px-6 py-2 font-bold text-white bg-green-500 rounded"
                >
                  Save
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import InputLabel from '@/components/InputLabel.vue';
import TextInput from '@/components/TextInput.vue';
import Textarea from '@/components/Textarea.vue';
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';

export default {
  name: 'PostCreate',

  components: {
    AuthenticatedLayout,
    InputLabel,
    TextInput,
    Textarea,
    Head,
    Link,
  },

  props: {
    post: {
      type: Object,
      required: true,
    },
  },

  data () {
    return {
      form: {
        title: this.post.title,
        content: this.post.content,
      },
      errors: {
        title: '',
        content: '',
      },
    };
  },

  methods: {
    submit () {
      this.clearFormErrors();
      this.updatePost();
    },

    clearFormErrors () {
      for (const [key] of Object.entries(this.errors)) {
        this.errors[key] = '';
      }
    },

    updatePost () {
      this.$axios.patch(`/posts/${this.post.id}`, this.form)
        .then(res => {
          this.$inertia.visit(route('posts.index'), { method: 'get' });
        })
        .catch(error => {
          if (error.response.data.errors) {
            for (const [key, value] of Object.entries(error.response.data.errors)) {
              this.errors[key] = value[0];
            }
          }
        });
    },
  },
};
</script>