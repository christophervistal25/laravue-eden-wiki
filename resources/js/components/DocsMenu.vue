<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 p-2">
    <h1
      class="text-gray-700 text-3xl uppercase font-bold tracking-widest border-b-2 border-green-200 border-dashed mb-2"
    >
      # Wiki
    </h1>
    <div class="grid grid-cols-3 gap-y-10 gap-x-10">
      <div
        v-for="category in categories"
        :key="category.id"
        class="py-5 border border-dashed border-gray-300 shadow-sm"
      >
        <ul>
          <div class="text-center">
            <span
              class="font-medium tracking-widest text-gray-700 text-2xl uppercase border-b-2 border-green-300"
              >{{ category.name }}</span
            >
          </div>
          <div class="ml-10">
            <li
              class="list-none text-sm my-4 text-gray-600 uppercase tracking-wider font-medium border-l-2 border-green-500 px-4 transition duration-300 ease-in-out cursor-pointer hover:text-gray-900"
              v-for="sub_category in category.sub_category"
              :key="sub_category.id"
            >
              <a :href="`/item/${sub_category.id}`">{{ sub_category.name }}</a>
            </li>
          </div>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    categories: Array,
  },
};
</script>

<style>
</style>