<template>
  <!-- This is an example component -->
  <div class="">
    <div class="h-full overflow-y-auto">
      <div class="">
        <!-- Cards -->
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
          <!-- Card -->
          <div
            class="flex items-center p-4 bg-white shadow-sm bord border-green-400 border-l-4"
          >
            <div class="p-3 mr-4 text-white bg-green-400 rounded-full">
              <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                ></path>
              </svg>
            </div>
            <div>
              <p
                class="mb-2 text-sm font-medium text-gray-800 dark:text-gray-400"
              >
                Categories
              </p>
              <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                <svg
                  v-if="no_of_categories === 0"
                  xmlns="http://www.w3.org/2000/svg"
                  class="animate-spin h-6 w-6"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="#000000"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5" />
                </svg>
                <span v-else>
                  {{ no_of_categories }}
                </span>
              </p>
            </div>
          </div>
          <!-- Card -->
          <div
            class="flex items-center p-4 bg-white shadow-sm border-green-400 border-l-4"
          >
            <div class="p-3 mr-4 text-white bg-green-400 rounded-full">
              <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h8m-8 6h16"
                ></path>
              </svg>
            </div>
            <div>
              <p
                class="mb-2 text-sm font-medium text-gray-800 dark:text-gray-400"
              >
                Sub Categories
              </p>
              <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                <svg
                  v-if="no_of_sub_categories === 0"
                  xmlns="http://www.w3.org/2000/svg"
                  class="animate-spin h-6 w-6"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="#000000"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5" />
                </svg>
                <span v-else>
                  {{ no_of_sub_categories }}
                </span>
              </p>
            </div>
          </div>
          <!-- Card -->
          <div
            class="flex items-center p-4 bg-white shadow-sm border-green-400 border-l-4"
          >
            <div class="p-3 mr-4 text-white bg-green-400 rounded-full">
              <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                ></path>
              </svg>
            </div>
            <div>
              <p
                class="mb-2 text-sm font-medium text-gray-800 dark:text-gray-400"
              >
                Items
              </p>
              <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                <svg
                  v-if="no_of_items === 0"
                  xmlns="http://www.w3.org/2000/svg"
                  class="animate-spin h-6 w-6"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="#000000"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5" />
                </svg>
                <span v-else>
                  {{ no_of_items }}
                </span>
              </p>
            </div>
          </div>
          <!-- Card -->
          <div
            class="flex items-center p-4 bg-white shadow-sm border-green-400 border-l-4"
          >
            <div class="p-3 mr-4 text-white bg-green-400 rounded-full">
              <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                ></path>
              </svg>
            </div>
            <div>
              <p
                class="mb-2 text-sm font-medium text-gray-800 dark:text-gray-400"
              >
                Articles
              </p>
              <p class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                <svg
                  v-if="no_of_articles === 0"
                  xmlns="http://www.w3.org/2000/svg"
                  class="animate-spin h-6 w-6"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="#000000"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5" />
                </svg>
                <span v-else>
                  {{ no_of_articles }}
                </span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      no_of_items: 0,
      no_of_articles: 0,
      no_of_categories: 0,
      no_of_sub_categories: 0,
    };
  },
  methods: {
    getItemsCount() {
      axios.get("/admin/widget/item/count").then((response) => {
        this.no_of_items = response.data;
      });
    },
    getArticlesCount() {
      axios.get("/admin/widget/article/count").then((response) => {
        this.no_of_articles = response.data;
      });
    },
    getCategoriesCount() {
      axios.get("/admin/widget/category/count").then((response) => {
        this.no_of_categories = response.data;
      });
    },
    getSubCategoriesCount() {
      axios.get("/admin/widget/sub/category/count").then((response) => {
        this.no_of_sub_categories = response.data;
      });
    },
  },
  created() {
    this.getCategoriesCount();
    this.getSubCategoriesCount();
    this.getItemsCount();
    this.getArticlesCount();
  },
};
</script>