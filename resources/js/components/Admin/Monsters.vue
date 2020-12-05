<template>
  <div>
    <div class="flex mt-5">
      <div
        class="mr-6 py-2 w-full flex-shrink-0 flex flex-col bg-white shadow-sm"
      >
        <h3
          class="flex flex-col px-5 font-semibold dark:text-gray-300 text-2xl"
        >
          <span>Monsters</span>
        </h3>
        <div class="flex flex-row justify-between">
          <input
            type="text"
            class="w-64 ml-5 bg-white border border-gray-400 focus:border-gray-500 px-4 py-2 text-sm focus:outline-none"
            v-model="search"
            @keyup.enter="searchMonster"
            placeholder="Search by title"
          />
          <a href="/admin/monster/create">
            <div
              class="float-right text-white bg-blue-400 rounded-full shadow w-10 animate-pulse mr-5 cursor-pointer"
            >
              <svg
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
            </div>
          </a>
        </div>
        <div class="flex flex-col px-5 py-3">
          <table class="table-fixed border-collapse">
            <thead>
              <tr>
                <td
                  class="border border-gray-300 w-1/4 px-4 py-3 uppercase text-center font-medium"
                >
                  title
                </td>
                <td
                  class="border border-gray-300 w-1/4 px-4 py-3 uppercase text-center font-medium"
                >
                  Slug
                </td>
                <td
                  class="border border-gray-300 w-1/4 px-4 py-3 uppercase text-center font-medium"
                >
                  created at
                </td>
                <td
                  class="border border-gray-300 w-10 px-4 py-3 uppercase text-center font-medium"
                >
                  Actions
                </td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="monster in monsters.data" :key="monster.id">
                <td
                  class="border border-gray-300 w-1/4 px-4 py-3 align-middle text-sm uppercase"
                >
                  {{ monster.slug.replace(/-/g, " ") }}
                </td>
                <td
                  class="border border-gray-300 w-1/4 px-4 py-3 align-middle text-sm"
                >
                  {{ monster.slug }}
                </td>
                <td class="border border-gray-300 w-1/4 px-4 py-3 text-center">
                  {{ formatDate(monster.created_at) }}
                </td>
                <td
                  class="border border-gray-300 w-10 p-2 capitalize align-middle cursor-pointer"
                >
                  <a :href="`/admin/monster/${monster.id}/edit`">
                    <div
                      class="w-10 h-10 bg-green-500 text-white rounded-full shadow p-2 mr-auto ml-auto cursor-pointer"
                    >
                      <svg
                        class="w-6 h-6 mr-auto ml-auto"
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
                    </div>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div
      class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
    >
      <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div>
          <p class="text-sm text-gray-700 tracking-wide">
            Showing
            <span class="font-medium"> {{ monsters.from }}</span>
            to
            <span class="font-medium"> {{ monsters.to }}</span>
            of
            <span class="font-medium">{{ monsters.total }}</span>
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
                monsters.prev_page_url == null
                  ? 'cursor-not-allowed bg-gray-50'
                  : 'cursor-pointer bg-white'
              "
              v-on:click="monsters.prev_page_url ? prev() : '#'"
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
            <select
              @change="changePage"
              class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm text-gray-700 hover:bg-gray-50 cursor-pointer w-auto focus:outline-none uppercase font-semibold"
              v-model="selectedPage"
            >
              <option
                :key="index"
                v-for="(page, index) in monsters.last_page"
                :value="page"
              >
                page : {{ page }}
              </option>
            </select>
            <!-- <a
                    v-for="(page, index) in items.last_page"
                   
                    
                    :class="
                      items.current_page === page
                        ? 'bg-gray-200 cursor-not-allowed font-medium'
                        : ''
                    "
                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm text-gray-700 hover:bg-gray-50 cursor-pointer"
                  >
                    {{ page }}
                  </a> -->
            <a
              :class="
                monsters.next_page_url == null
                  ? 'cursor-not-allowed bg-gray-50'
                  : 'cursor-pointer bg-white'
              "
              v-on:click="monsters.next_page_url ? next() : '#'"
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
      monsters: [],
      monstersBeforeSearch: [],
      search: "",
      selectedPage: 1,
    };
  },
  methods: {
    get() {
      axios.get("/admin/records/monster").then((response) => {
        this.monsters = response.data;
      });
    },
    searchMonster() {
      this.monstersBeforeSearch = this.monsters;
      axios.get(`/admin/monster/search/${this.search}`).then((response) => {
        this.monsters = response.data;
      });
    },
    changePage() {
      if (this.monsters.current_page !== this.selectedPage) {
        axios
          .get(`${this.monsters.path}?page=${this.selectedPage}`)
          .then((response) => (this.monsters = response.data));
      }
    },
    prev() {
      axios.get(this.monsters.prev_page_url).then((response) => {
        this.selectedPage--;
        this.monsters = response.data;
      });
    },
    next() {
      axios.get(this.monsters.next_page_url).then((response) => {
        this.selectedPage++;
        this.monsters = response.data;
      });
    },
    formatDate(date) {
      return moment(date).format("MMMM Do YYYY, h:mm A");
    },
  },
  created() {
    this.get();
  },
  watch: {
    search(to) {
      if (!to) {
        this.monsters = this.monstersBeforeSearch;
      }
    },
  },
};
</script>
