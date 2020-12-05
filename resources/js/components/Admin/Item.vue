<template>
  <div class="flex mt-5">
    <div
      class="mr-6 py-2 w-full flex-shrink-0 flex flex-col bg-white shadow-sm"
    >
      <h3 class="flex flex-col px-5 font-semibold dark:text-gray-300 text-2xl">
        <span>Items</span>
      </h3>
      <div class="flex flex-col p-8 py-3">
        <div>
          <div>
            <input
              class="w-64 bg-white border border-gray-300 focus:border-gray-400 px-4 py-2 text-sm focus:outline-none mb-2"
              type="text"
              v-model="search"
              @keyup.enter="searchItem"
              placeholder="Search"
            />

            <!-- BUTTON ADD CATEGORY -->
            <div
              class="float-right text-white bg-blue-400 rounded-full shadow w-10 animate-pulse cursor-pointer"
            >
              <a href="/admin/item/create">
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
                  class="px-4 border py-4 w-1/9 text-sm uppercase text-center font-bold text-gray-700"
                >
                  Icon
                </td>
                <td
                  class="px-4 border py-4 w-1/4 text-sm uppercase text-center font-bold text-gray-700"
                >
                  Name
                </td>
                <td
                  class="px-4 border py-4 w-1/4 text-sm uppercase text-center font-bold text-gray-700"
                >
                  Description
                </td>
                <td
                  class="px-4 border py-4 w-1/9 text-sm uppercase text-center font-bold text-gray-700"
                >
                  Gender
                </td>
                <td
                  class="px-4 border py-4 text-sm uppercase text-center font-bold text-gray-700"
                >
                  Level
                </td>
                <td
                  class="px-4 border py-4 w-1/6 text-sm uppercase text-center font-bold text-gray-700"
                >
                  Job
                </td>
                <td
                  class="px-4 border py-4 w-1/4 text-sm uppercase text-center font-bold text-gray-700"
                >
                  Category / Sub-Category
                </td>
                <th
                  class="px-4 border py-4 w-1/9 text-sm uppercase text-center font-bold text-gray-700"
                >
                  Status
                </th>
                <!-- <th
                  class="px-4 border py-4 w-1/5 text-sm uppercase text-center font-bold text-gray-700"
                >
                  Created At
                </th> -->
                <th
                  class="px-4 border py-4 text-sm uppercase text-center font-bold text-gray-700"
                >
                  Actions
                </th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="item in items.data"
                v-bind:key="item.id"
                class="hover:bg-gray-100"
              >
                <td class="border px-4 py-1 capitalize">
                  <div v-if="!imageLoadList.includes(item.name)">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="animate-spin w-5 mr-auto ml-auto object-scale-down"
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
                    <!-- <div
                class="w-8 h-8 bg-green-300 animate-pulse rounded-full"
              ></div> -->
                  </div>
                  <img
                    class="object-scale-down mr-auto ml-auto w-10"
                    :src="/images/ + item.icon"
                    @load="onImageLoad(item.name)"
                    alt=""
                  />
                </td>
                <td class="border px-4 py-1 capitalize text-sm">
                  {{ item.name }}
                </td>
                <td class="border px-4 py-1 text-sm text-gray-800">
                  {{ item.description.substring(0, 30) }}...
                </td>
                <td
                  class="border px-4 py-1 capitalize text-gray-800 text-center text-sm font-medium"
                >
                  {{
                    item.gender.toLowerCase() === "="
                      ? ""
                      : item.gender.toLowerCase().substr(0, 1)
                  }}
                </td>
                <td
                  class="border px-4 py-1 capitalize text-gray-800 text-center text-sm"
                >
                  {{ item.level }}
                </td>
                <td
                  class="border px-4 py-1 capitalize text-gray-800 text-center text-sm"
                >
                  {{
                    item.job.toLowerCase() === "=" ? "" : item.job.toLowerCase()
                  }}
                </td>
                <td class="text-center border px-4 py-2">
                  <span
                    class="w-auto cursor-default focus:outline-none font-body py-1 px-4 capitalize text-gray-800 text-sm"
                  >
                    {{ item.sub_category.category.name }} /
                    {{ item.sub_category.name.toLowerCase() }}
                  </span>
                </td>
                <td class="text-center border px-4 py-1 text-sm">
                  <button
                    v-if="item.status == 'active'"
                    class="button-small cursor-default focus:outline-none p-1 rounded-full"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="icon icon-tabler icon-tabler-check w-5 h-5"
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
                      <path d="M5 12l5 5l10 -10" />
                    </svg>
                  </button>
                  <button
                    v-else
                    class="cursor-default focus:outline-none text-white font-medium p-1 rounded-sm uppercase"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="icon icon-tabler icon-tabler-x w-5 h-5"
                      width="44"
                      height="44"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="#ff2825"
                      fill="none"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <line x1="18" y1="6" x2="6" y2="18" />
                      <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                  </button>
                </td>

                <!-- <td class="border px-4 py-1 text-center text-sm">
                  {{ formatDate(item.created_at) }}
                </td> -->

                <td class="border px-4 py-1 text-center">
                  <a :href="`/admin/item/${item.id}/edit`">
                    <div
                      class="w-8 h-8 bg-green-500 text-white rounded-full shadow p-2 mr-auto ml-auto cursor-pointer"
                    >
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
                    </div>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>

          <div
            class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
          >
            <div
              class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
            >
              <div>
                <p class="text-sm text-gray-700 tracking-wide">
                  Showing
                  <span class="font-medium"> {{ items.from }}</span>
                  to
                  <span class="font-medium"> {{ items.to }}</span>
                  of
                  <span class="font-medium">{{ items.total }}</span>
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
                      items.prev_page_url == null
                        ? 'cursor-not-allowed bg-gray-50'
                        : 'cursor-pointer bg-white'
                    "
                    v-on:click="items.prev_page_url ? prev() : '#'"
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
                      v-for="(page, index) in items.last_page"
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
                      items.next_page_url == null
                        ? 'cursor-not-allowed bg-gray-50'
                        : 'cursor-pointer bg-white'
                    "
                    v-on:click="items.next_page_url ? next() : '#'"
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
      </div>
    </div>
  </div>
</template>
<script>
export default {
  components: {
    // Spinner,
  },
  data() {
    return {
      items: [],
      itemsBeforeSearch: [],
      search: "",
      selectedPage: 1,
      imageLoadList: [],
    };
  },
  methods: {
    get() {
      axios
        .get("records/item")
        .then((response) => (this.items = response.data));
    },
    searchItem() {
      this.itemsBeforeSearch = this.items;
      axios.get(`/admin/item/search/${this.search}`).then((response) => {
        this.items = response.data;
      });
    },
    changePage() {
      if (this.items.current_page !== this.selectedPage) {
        axios
          .get(`${this.items.path}?page=${this.selectedPage}`)
          .then((response) => (this.items = response.data));
      }
    },
    prev() {
      axios.get(this.items.prev_page_url).then((response) => {
        this.items = response.data;
        this.selectedPage--;
      });
    },
    next() {
      axios.get(this.items.next_page_url).then((response) => {
        this.items = response.data;
        this.selectedPage++;
      });
    },
    onImageLoad(item_name) {
      this.imageLoadList.push(item_name);
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
        this.items = this.itemsBeforeSearch;
      }
    },
  },
};
</script>