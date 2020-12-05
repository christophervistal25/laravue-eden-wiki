<template>
  <div>
    <div>
      <p class="text-gray text-sm">(Press enter after you type a keyword)</p>
      <input
        class="w-64 bg-white border border-gray-300 focus:border-gray-400 px-4 py-2 text-sm focus:outline-none mb-2"
        type="text"
        v-model="search"
        @keyup.enter="searchSubCategory"
        placeholder="Search"
      />

      <!-- BUTTON ADD CATEGORY -->
      <div
        class="float-right text-white bg-blue-400 rounded-full shadow w-10 animate-pulse cursor-pointer"
      >
        <a href="/admin/sub/category/create">
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
            class="w-1/5 border py-3 px-4 text-gray-700 text-sm uppercase text-center font-bold tracking-wider"
          >
            Name
          </td>
          <td
            class="w-1/5 border py-3 px-4 text-gray-700 text-sm uppercase text-center font-bold tracking-wider"
          >
            No. of items
          </td>
          <td
            class="w-1/5 border py-3 px-4 text-gray-700 text-sm uppercase text-center font-bold tracking-wider"
          >
            Category
          </td>
          <td
            class="w-1/5 border py-3 px-4 text-gray-700 text-sm uppercase text-center font-bold tracking-wider"
          >
            Status
          </td>
          <td
            class="w-1/2 border py-3 px-4 text-gray-700 text-sm uppercase text-center font-bold tracking-wider"
          >
            Created At
          </td>
          <td
            class="w-1/2 border py-3 px-4 text-gray-700 text-sm uppercase text-center font-bold tracking-wider"
          >
            Actions
          </td>
        </tr>
      </thead>
      <tbody>
        <tr
          class="hover:bg-gray-100"
          v-for="sub_category in sub_categories.data"
          v-bind:key="sub_category.id"
        >
          <td class="border px-4 py-1 capitalize text-sm">
            {{ sub_category.name }}
          </td>
          <td class="border px-4 py-1 capitalize text-center text-sm">
            {{ sub_category.items_count }}
          </td>
          <td class="text-center border px-4 py-1 text-sm">
            <button
              class="bg-blue-500 cursor-default focus:outline-none w-40 text-white p-1 rounded-sm uppercase font-medium"
            >
              {{ sub_category.category.name }}
            </button>
          </td>
          <td class="text-center border px-4 py-1 text-sm">
            <button
              v-if="sub_category.status == 'active'"
              class="button-small bg-green-500 cursor-default focus:outline-none w-20 text-white font-medium p-1 rounded-sm uppercase"
            >
              {{ sub_category.status }}
            </button>
            <button
              v-else
              class="bg-red-500 cursor-default focus:outline-none w-20 text-white font-body p-1 rounded-sm font-medium uppercase"
            >
              {{ sub_category.status }}
            </button>
          </td>

          <td class="border px-4 py-1 text-center text-sm">
            {{ formatDate(sub_category.created_at) }}
          </td>

          <td class="border px-4 py-1">
            <div
              class="w-10 h-10 bg-green-500 text-white rounded-full shadow p-2 mr-auto ml-auto cursor-pointer"
            >
              <a :href="`/admin/sub/category/${sub_category.id}/edit`">
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
            <span class="font-medium"> {{ sub_categories.from }}</span>
            to
            <span class="font-medium"> {{ sub_categories.to }}</span>
            of
            <span class="font-medium">{{ sub_categories.total }}</span>
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
                sub_categories.prev_page_url == null
                  ? 'cursor-not-allowed bg-gray-50'
                  : 'cursor-pointer bg-white'
              "
              v-on:click="sub_categories.prev_page_url ? prev() : '#'"
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
              v-for="(page, index) in sub_categories.last_page"
              @click="pageClick(page)"
              :key="index"
              :class="
                sub_categories.current_page === page
                  ? 'bg-gray-200 cursor-not-allowed font-medium'
                  : ''
              "
              class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm text-gray-700 hover:bg-gray-50 cursor-pointer"
            >
              {{ page }}
            </a>
            <a
              :class="
                sub_categories.next_page_url == null
                  ? 'cursor-not-allowed bg-gray-50'
                  : 'cursor-pointer bg-white'
              "
              v-on:click="sub_categories.next_page_url ? next() : '#'"
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
      sub_categories: [],
      search: "",
      beforeSearchSubCategories: [],
    };
  },
  watch: {},
  methods: {
    get() {
      axios.get("/admin/sub/category").then((response) => {
        this.sub_categories = response.data;
      });
    },
    searchSubCategory() {
      this.beforeSearchSubCategories = this.sub_categories;
      axios
        .get(`/admin/sub/category/search/${this.search}`)
        .then((response) => {
          this.sub_categories = response.data;
        });
      console.log(this.sub_categories);
    },
    pageClick(page) {
      if (this.sub_categories.current_page !== page) {
        axios
          .get(`${this.sub_categories.path}?page=${page}`)
          .then((response) => (this.sub_categories = response.data));
      }
    },
    prev() {
      axios
        .get(this.sub_categories.prev_page_url)
        .then((response) => (this.sub_categories = response.data));
    },
    next() {
      axios
        .get(this.sub_categories.next_page_url)
        .then((response) => (this.sub_categories = response.data));
    },
    formatDate(date) {
      return moment(date).format("MMMM Do YYYY, h:mm A");
    },
  },
  computed: {},
  created() {
    this.get();
  },
  watch: {
    search(to) {
      if (!to) {
        this.sub_categories = this.beforeSearchSubCategories;
      }
    },
  },
};
</script>