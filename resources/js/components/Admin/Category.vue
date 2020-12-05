<template>
  <div>
    <div>
      <p class="text-gray text-sm">(Press enter after you type a keyword)</p>
      <input
        class="w-64 bg-white border border-gray-300 focus:border-gray-400 px-4 py-2 text-sm focus:outline-none mb-2"
        type="text"
        v-model="search"
        @keyup.enter="searchCategory"
        placeholder="Search by name"
      />

      <!-- BUTTON ADD CATEGORY -->
      <div
        class="float-right text-white bg-blue-400 rounded-full shadow w-10 animate-pulse cursor-pointer"
      >
        <a href="/admin/category/create">
          <svg
            ref="btnRef"
            class="w-10 h-10"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
            ></path>
          </svg>
        </a>
      </div>
    </div>

    <table class="table-auto">
      <thead>
        <tr>
          <td
            class="border w-1/5 px-3 py-3 text-sm uppercase text-gray-700 font-bold text-center tracking-wider"
          >
            Name
          </td>
          <td
            class="border w-1/5 px-3 py-3 text-sm uppercase text-gray-700 font-bold text-center tracking-wider"
          >
            Description
          </td>
          <td
            class="border w-1/5 px-3 py-3 text-sm uppercase text-gray-700 font-bold text-center tracking-wider"
          >
            No. of Sub-category
          </td>
          <td
            class="border w-1/5 px-3 py-3 text-sm uppercase text-gray-700 font-bold text-center tracking-wider"
          >
            Status
          </td>
          <td
            class="border w-1/2 px-3 py-3 text-sm uppercase text-gray-700 font-bold text-center tracking-wider"
          >
            Created At
          </td>
          <td
            class="border w-1/2 px-3 py-3 text-sm uppercase text-gray-700 font-bold text-center tracking-wider"
          >
            Actions
          </td>
        </tr>
      </thead>
      <tbody>
        <tr
          class="hover:bg-gray-100"
          v-for="category in categories.data"
          :key="category.id"
        >
          <td class="border px-4 py-1 capitalize text-sm">
            {{ category.name }}
          </td>
          <td class="border px-4 py-1 text-sm text-gray-700">
            {{
              category.description
                ? category.description.substring(0, 20) + "..."
                : ""
            }}
          </td>
          <td class="border px-4 py-1 text-center text-sm">
            <span v-if="category.type !== 0">
              {{ category.sub_category_count }}
            </span>
            <span v-else class="text-red-400 font-medium"> N/A </span>
          </td>
          <td class="border px-4 py-1 text-center text-sm">
            <button
              v-if="category.status == 'active'"
              class="bg-green-500 cursor-default focus:outline-none w-20 text-white font-body p-1 uppercase font-medium rounded-sm"
            >
              {{ category.status }}
            </button>

            <button
              v-else
              class="bg-red-500 cursor-default focus:outline-none w-20 text-white font-body p-1 uppercase font-medium rounded-sm"
            >
              {{ category.status }}
            </button>
          </td>
          <td class="border px-4 py-1 text-center text-sm">
            {{ formatDate(category.created_at) }}
          </td>
          <td class="border px-4 py-1 text-center">
            <div
              class="w-10 h-10 bg-green-500 text-white rounded-full shadow p-2 mr-auto ml-auto"
            >
              <a :href="`/admin/category/${category.id}/edit`">
                <svg
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                  ></path>
                </svg>
              </a>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <div
      class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
    >
      <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div>
          <p class="text-sm text-gray-700 tracking-wide">
            Showing
            <span class="font-medium"> {{ categories.from }}</span>
            to
            <span class="font-medium"> {{ categories.to }}</span>
            of
            <span class="font-medium">{{ categories.total }}</span>
            results
          </p>
        </div>
        <div>
          <nav
            class="relative z-0 inline-flex -space-x-px"
            aria-label="Pagination"
          >
            <a
              :class="
                categories.prev_page_url == null
                  ? 'cursor-not-allowed bg-gray-50'
                  : 'cursor-pointer bg-white'
              "
              v-on:click="categories.prev_page_url ? prev() : '#'"
              class="relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm focus:outline-none font-medium text-gray-500 hover:bg-gray-50"
            >
              <span class="sr-only">Previous</span>
              <svg
                class="h-5 w-5"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                aria-hidden="true"
              >
                <path
                  fill-rule="evenodd"
                  d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                  clip-rule="evenodd"
                />
              </svg>
            </a>
            <a
              v-for="(page, index) in categories.last_page"
              @click="pageClick(page)"
              :key="index"
              :class="
                categories.current_page === page
                  ? 'bg-gray-200 cursor-not-allowed font-medium'
                  : ''
              "
              class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm text-gray-700 hover:bg-gray-50 cursor-pointer"
            >
              {{ page }}
            </a>
            <a
              :class="
                categories.next_page_url == null
                  ? 'cursor-not-allowed bg-gray-50'
                  : 'cursor-pointer bg-white'
              "
              v-on:click="categories.next_page_url ? next() : '#'"
              class="relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
            >
              <span class="sr-only">Next</span>
              <svg
                class="h-5 w-5"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                aria-hidden="true"
              >
                <path
                  fill-rule="evenodd"
                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                  clip-rule="evenodd"
                />
              </svg>
            </a>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      categories: [],
      beforeSearchCategories: [],
      search: "",
    };
  },
  methods: {
    get() {
      axios
        .get("/admin/categories")
        .then((response) => (this.categories = response.data));
    },
    searchCategory() {
      this.beforeSearchCategories = this.categories;
      axios.get(`/admin/category/search/${this.search}`).then((response) => {
        this.categories = response.data;
      });
    },
    pageClick(page) {
      if (this.categories.current_page !== page) {
        axios
          .get(`${this.categories.path}?page=${page}`)
          .then((response) => (this.categories = response.data));
      }
    },
    prev() {
      axios
        .get(this.categories.prev_page_url)
        .then((response) => (this.categories = response.data));
    },
    next() {
      axios
        .get(this.categories.next_page_url)
        .then((response) => (this.categories = response.data));
    },
    formatDate(date) {
      return moment(date).format("MMMM Do YYYY, h:mm A");
    },
  },
  created() {
    this.get();
  },
  watch: {
    search(to, from) {
      if (!to) {
        this.categories = this.beforeSearchCategories;
      }
    },
  },
};
</script>