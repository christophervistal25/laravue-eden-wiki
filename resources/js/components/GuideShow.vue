<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 p-2">
    <button
      @click="back"
      class="bg-green-300 rounded-full shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 focus:outline-none"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="icon icon-tabler icon-tabler-arrow-narrow-left"
        width="44"
        height="44"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="#000000"
        fill="none"
        stroke-linecap="round"
        stroke-linejoin="round"
      >
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <line x1="5" y1="12" x2="19" y2="12" />
        <line x1="5" y1="12" x2="9" y2="16" />
        <line x1="5" y1="12" x2="9" y2="8" />
      </svg>
    </button>
    <h1
      class="text-gray-700 text-3xl uppercase font-bold tracking-widest border-b-2 border-green-200 border-dashed mt-1"
    >
      {{ post.title }}
    </h1>
    <div>
      <div v-html="post.content"></div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    post: Object,
  },
  created() {
    axios.put(`/guide/${this.post.slug}/views`).then((response) => {});
  },
  methods: {
    back() {
      window.location.href = "/guides";
    },
  },
};
</script>

<style>