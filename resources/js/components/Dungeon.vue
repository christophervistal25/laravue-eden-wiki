<template>
  <div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 p-2">
      <h1
        class="text-gray-700 text-3xl uppercase font-bold tracking-widest border-b-2 border-green-200 border-dashed mb-2"
      >
        # Dungeons
      </h1>
      <div class="grid grid-cols-3 gap-y-10 gap-x-10">
        <div
          class="py-5 border border-dashed border-gray-300 shadow-sm"
          v-for="(dungeon, index) in dungeons"
          :key="index"
        >
          <ul>
            <div class="ml-10">
              <li
                class="list-none text-sm my-4 text-gray-600 uppercase tracking-wider font-medium border-l-2 border-green-400 px-4 transition duration-500 ease-in-out cursor-pointer hover:text-gray-900"
                v-for="m in dungeon"
                :key="m.id"
              >
                <a :href="`/dungeon/${m.slug}`">{{
                  m.slug.replace(/-/g, " ")
                }}</a>
              </li>
            </div>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dungeons: [],
    };
  },
  methods: {
    get() {
      axios.get("/dungeon/list").then((response) => {
        this.dungeons = response.data;
        console.log(response.data);
      });
    },
  },
  created() {
    this.get();
  },
};
</script>

<style>
</style>