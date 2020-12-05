<template>
  <div class="flex">
    <div
      class="mr-6 py-2 w-full flex-shrink-0 flex flex-col bg-white dark:bg-gray-600 rounded-sm shadow-lg"
    >
      <h3 class="flex flex-col px-5 text-2xl font-semibold dark:text-gray-300">
        <span>Create Set</span>
      </h3>
      <div class="flex flex-col px-5">
        <hr class="my-2" />

        <p
          class="text-red-500 text-sm ml-3 my-1"
          v-for="(error, index) in formError.errors"
          :key="index"
        >
          <span>&#9862;</span> {{ error[0] }}
        </p>
        <hr v-show="formError.errors" class="my-2" />

        <form @submit.prevent="">
          <div class="w-full px-3">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >
              Name
            </label>
            <input
              class="appearance-none block w-full text-gray-700 border rounded-sm py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500"
              type="text"
              v-model="name"
            />
          </div>

          <hr class="mb-2" />

          <div class="px-3 mb-2">
            <button
              :class="
                selectedItems.length !== 0 ? 'bg-green-500' : 'bg-gray-700'
              "
              class="text-white shadow py-2 px-2 rounded-sm focus:outline-none mb-2"
              @click="linkItemModalShow = true"
              type="button"
            >
              <span v-if="selectedItems.length" class="text-sm">
                {{ selectedItems.length }} Parts Selected
              </span>
              <span class="text-sm" v-else> Select Parts </span>
            </button>
            <br />

            <span
              class="p-2 inline-block text-sm"
              v-for="selectedItem in selectedItems"
              :key="selectedItem.id"
            >
              <img
                class="object-scale-down animate-pulse bg-gray-300 p-1 rounded-full shadow-lg mb-2 mr-auto ml-auto"
                :src="/images/ + selectedItem.icon"
              />
              {{ selectedItem.name }}
            </span>
            <hr class="mb-2" />
          </div>

          <div class="w-full px-3 mb-2">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >
              Set effects
            </label>
            <button
              class="rounded-full bg-blue-500 text-white w-10 py-2 hover:shadow-lg focus:outline-none"
              @click="addSetEffectField"
              type="button"
            >
              +
            </button>
          </div>

          <div v-for="(item, i) in setEffects.length" :key="i">
            <div class="flex flex-row px-3 space-x-3">
              <input
                class="appearance-none block w-1/2 text-gray-700 border rounded-sm py-3 px-4 mb-3 focus:outline-none bg-white border-gray-500"
                type="text"
                placeholder="e.g 4/4"
                v-model="setEffects[i].no_of_parts"
              />

              <input
                class="appearance-none block w-1/2 text-gray-700 border rounded-sm py-3 px-4 mb-3 focus:outline-none bg-white border-gray-500 uppercase"
                type="text"
                v-model="setEffects[i].attribute"
                placeholder="STR"
              />

              <input
                class="appearance-none block w-1/2 text-gray-700 border rounded-sm py-3 px-4 mb-3 focus:outline-none bg-white border-gray-500"
                type="text"
                v-model="setEffects[i].attribute_value"
                placeholder="+20"
              />

              <button
                class="rounded-full bg-red-500 text-white w-10 h-full mt-3 font-semibold hover:shadow-lg focus:outline-none"
                @click="removeField(i)"
                type="button"
              >
                ×
              </button>
            </div>
          </div>
          <hr />
          <button
            @click="submitSet"
            class="float-right shadow bg-blue-500 hover:bg-blue-400 mt-2 focus:border-blue-500 focus:outline-none text-white py-2 px-4 rounded-sm uppercase"
            type="submit"
          >
            Create Set
          </button>
          <div class="clearfix"></div>
        </form>
      </div>
    </div>
    <div
      v-if="linkItemModalShow"
      class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex"
    >
      <div class="relative w-screen my-6 mx-auto text-sm mt-64 px-10">
        <!--content-->
        <div
          class="border-0 rounded-sm shadow-sm relative flex flex-col w-full bg-white outline-none focus:outline-none"
        >
          <!--header-->
          <div
            class="flex items-start justify-between p-5 border-b border-solid border-gray-300 rounded-t"
          >
            <h3 class="text-3xl font-semibold">Items</h3>
            <button
              class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
            >
              <span
                class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none"
                @click="linkItemModalShow = false"
              >
                ×
              </span>
            </button>
          </div>
          <!--body-->
          <div class="relative p-6">
            <span class="text-sm text-gray-700"
              ><small
                >Don't forget to press (ENTER) key after you typed.</small
              ></span
            >
            <br />
            <input
              id="search-item"
              class="mb-1 w-64 bg-white border border-gray-400 focus:border-gray-500 px-4 py-2 text-sm focus:outline-none"
              type="text"
              v-model="search"
              @keyup.enter="searchItem"
              placeholder="Search"
            />
            <table class="table-fixed table-collapse">
              <thead>
                <tr>
                  <td
                    class="border border-gray-300 p-2 w-auto px-3 py-3 font-medium uppercase"
                  >
                    Select
                  </td>
                  <td
                    class="border border-gray-300 p-2 w-auto px-3 py-3 font-medium uppercase"
                  >
                    Icon
                  </td>
                  <td
                    class="border border-gray-300 p-2 w-1/2 font-medium uppercase text-center"
                  >
                    Name
                  </td>
                  <td
                    class="border border-gray-300 p-2 w-1/5 font-medium uppercase text-center"
                  >
                    Sub - Category
                  </td>
                  <td
                    class="border border-gray-300 p-2 w-auto font-medium uppercase"
                  >
                    Level
                  </td>
                  <td
                    class="border border-gray-300 p-2 w-1/3 font-medium uppercase text-center"
                  >
                    Job
                  </td>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="item in items.data"
                  :key="item.id"
                  class="hover:bg-gray-300 cursor-pointer"
                  @click="select(item)"
                  style="transition: all 0.15s ease"
                >
                  <td
                    class="border border-gray-300 p-2 w-auto text-center cursor-pointer"
                  >
                    <input
                      type="checkbox"
                      :checked="selectedItems.includes(item)"
                    />
                  </td>
                  <td class="border border-gray-300 p-2 w-auto">
                    <img
                      class="object-contain mr-auto ml-auto"
                      :src="'/images/' + item.icon"
                      alt=""
                    />
                  </td>
                  <td
                    class="cursor-pointer border border-gray-300 p-2 w-1/2 capitalize"
                    style="transition: all 0.15s ease"
                  >
                    {{ item.name }}
                  </td>
                  <td
                    class="border border-gray-300 p-2 w-1/5 text-center capitalize"
                  >
                    {{ item.sub_category.name }}
                  </td>
                  <td class="border border-gray-300 p-2 w-auto text-center">
                    {{ item.level }}
                  </td>
                  <td class="border border-gray-300 p-2 w-1/3 text-center">
                    {{ item.job }}
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
          <!--footer-->
          <div
            class="flex items-center justify-end p-6 border-t border-solid border-gray-300 rounded-b"
          >
            <button
              class="text-white rounded-sm bg-blue-500 px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 uppercase"
              type="button"
              @click="linkItemModalShow = false"
              style="transition: all 0.15s ease"
            >
              apply selected parts
            </button>
          </div>
        </div>
      </div>
    </div>
    <div
      v-if="linkItemModalShow"
      class="opacity-25 fixed inset-0 z-40 bg-black"
    ></div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      linkItemModalShow: false,

      name: "",
      setEffects: [],
      selectedItems: [],
      formError: [],

      selectedPage: 1,
      items: [],
      itemsBeforeSearch: [],
      search: "",
    };
  },
  methods: {
    getItemsForLinking() {
      axios.get("/admin/records/set/item").then((response) => {
        this.items = response.data;
      });
    },
    searchItem() {
      this.itemsBeforeSearch = this.items;
      axios.get(`/admin/set/item/search/${this.search}`).then((response) => {
        this.items = response.data;
      });
    },
    addSetEffectField() {
      this.setEffects.push({
        no_of_parts: "0 / " + this.selectedItems.length,
        attribute: "",
        attribute_value: "",
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
    select(item) {
      if (this.selectedItems.includes(item)) {
        // Remove the item
        this.selectedItems = this.selectedItems.filter(
          (data) => data.id !== item.id
        );
      } else {
        this.selectedItems.push(item);
      }
    },
    removeField(index) {
      this.setEffects = this.setEffects.filter((data, i) => i !== index);
    },
    submitSet() {
      let selectedItems = [];

      this.selectedItems.map((data) => {
        selectedItems.push({
          id: data.id,
          type: data.sub_category.category.name,
        });
      });

      let data = {
        name: this.name,
        effects: JSON.stringify(this.setEffects),
        item_parts: JSON.stringify(selectedItems),
      };
      this.formError = [];
      axios
        .post("/admin/set/create", data)
        .then((response) => {
          if (response.status === 201) {
            swal("Good job!", `Successfully create new set.`, "success");
            this.name = "";
            this.setEffects = [];
            this.selectedItems = [];
          }
        })
        .catch((err) => {
          if (err.response.status === 422) {
            this.formError = err.response.data;
          }
        });
    },
  },
  created() {
    this.getItemsForLinking();
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
