<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 p-2">
    <h1
      class="text-gray-700 text-3xl uppercase font-bold tracking-widest border-b-2 border-green-200 border-dashed"
    >
      # Guides
    </h1>
    <div class="bg-gray-200 py-5 mt-2 shadow-xl">
      <div
        v-for="article in articles"
        :key="article.id"
        class="w-full md:px-4 cursor-pointer px-5"
        @click="show(article.slug)"
      >
        <div class="bg-white border border-gray-300 shadow-sm mt-2">
          <div>
            <img
              src="https://res.cloudinary.com/dfm6cr1l9/image/upload/v1606316339/eden/FAVPNG_elsword-character-concept-art-elesis_pfAdthBe_jmdmct.png"
              alt=""
              class="h-56 w-full object-cover object-top"
            />
          </div>

          <div class="px-4 py-4 md:px-10">
            <h1 class="font-bold text-2xl uppercase tracking-widest">
              {{ article.title }}
            </h1>
            <p class="flex flex-row">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="icon icon-tabler icon-tabler-eye w-6 h-6"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="#000000"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <circle cx="12" cy="12" r="2" />
                <path
                  d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"
                />
              </svg>
              <span class="ml-2">{{ article.views }}</span>
            </p>
            <p class="mt-1 text-sm">{{ article.created_at }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    articles: Array,
  },
  methods: {
    show(slug) {
      window.location.href = `/guide/${slug}`;
    },
  },
};
</script>

<style>
</style>