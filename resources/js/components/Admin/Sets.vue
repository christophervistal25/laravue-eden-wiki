<template>
  <div>
    <div class="flex mt-5">
      <div
        class="mr-6 py-2 w-full flex-shrink-0 flex flex-col bg-white shadow-sm"
      >
        <h3
          class="flex flex-col px-5 font-semibold dark:text-gray-300 text-2xl"
        >
          <span>Sets</span>
        </h3>
        <div class="flex flex-row justify-between">
          <input
            type="text"
            class="w-64 ml-5 bg-white border border-gray-400 focus:border-gray-500 px-4 py-2 text-sm focus:outline-none"
            v-model="search"
            @keyup.enter="searchSet"
            placeholder="Search by name"
          />
          <a href="/admin/set/create">
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
                  Name
                </td>
                <td
                  class="border border-gray-300 w-1/4 px-4 py-3 uppercase text-center font-medium"
                >
                  category
                </td>
                <td
                  class="border border-gray-300 w-1/4 px-4 py-3 uppercase text-center font-medium"
                >
                  Set effects
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
              <tr v-for="set in sets.data" :key="set.id">
                <td
                  class="border border-gray-300 w-1/4 px-4 py-3 capitalize align-middle text-center text-sm"
                >
                  {{ set.name }}
                </td>
                <td
                  class="border border-gray-300 w-1/4 px-4 py-3 capitalize align-middle text-center text-sm"
                >
                  <span
                    class="bg-green-500 text-white p-1 rounded-sm uppercase font-medium px-2"
                  >
                    {{ set.type }}
                  </span>
                </td>
                <td class="border border-gray-300 w-1/4 px-4 py-3">
                  <div
                    class="w-10 h-10 bg-blue-500 text-white rounded-full shadow p-2 mr-auto ml-auto cursor-pointer"
                    @click="viewSetEffects(set)"
                  >
                    <svg
                      class="w-6 h-6 ml-auto mr-auto"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                      />
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                      />
                    </svg>
                  </div>
                </td>
                <td
                  class="border border-gray-300 w-10 p-2 capitalize align-middle text-center text-sm"
                >
                  {{ formatDate(set.created_at) }}
                </td>
                <td
                  class="border border-gray-300 w-10 p-2 capitalize align-middle cursor-pointer"
                >
                  <a :href="`/admin/set/${set.id}/edit`">
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
      v-if="showModalSetEffect"
      class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex"
    >
      <div
        class="relative w-auto my-6 mx-auto max-w-3xl transition duration-500 ease-in-out bg-blue-600"
      >
        <!--content-->
        <div
          class="border-0 rounded-sm shadow-sm relative flex flex-col w-full bg-white outline-none focus:outline-none"
        >
          <!--header-->
          <div
            class="flex items-start justify-between p-5 border-b border-solid border-gray-300 rounded-t"
          >
            <h3 class="text-2xl font-semibold capitalize">
              {{ selectedSet.name }} effects
            </h3>
            <button
              class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
              v-on:click="closeShowEffect"
            >
              <span
                class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none"
              >
                ×
              </span>
            </button>
          </div>
          <!--body-->
          <div class="relative p-6 flex-auto">
            <span class="font-semibold">Parts : </span>
            <div class="container mt-0">
              <div class="flex flex-row">
                <img
                  class="object-scale-down mr-2 align-middle bg-gray-300 p-1 rounded-full shadow-lg"
                  v-for="(item, index) in selectedSet.items"
                  :key="index"
                  :src="'/images/' + item.icon"
                  alt=""
                />
              </div>

              <span
                class="capitalize"
                v-for="(effect, index) in JSON.parse(selectedSet.parts)"
                :key="index"
              >
                <button
                  class="ml-2 bg-green-500 text-white active:bg-green-600 uppercase text-sm px-3 outline-none focus:outline-none mt-3 rounded-sm"
                  style="transition: all 0.15s ease"
                >
                  {{
                    effect
                      .replace(/_/gi, " ")
                      .replace(/parts/gi, "")
                      .toLowerCase()
                  }}
                </button>
              </span>
            </div>

            <hr class="my-2" />
            <span class="font-semibold">Set Effect :</span>
            <table class="table-fixed mt-2 ml-auto mr-auto">
              <thead>
                <tr class="text-center font-semibold">
                  <td
                    class="w-64 border border-gray-300 px-4 py-2 capitalize text-sm"
                  >
                    No of parts
                  </td>
                  <td
                    class="w-64 border border-gray-300 px-4 py-2 capitalize text-sm"
                  >
                    Attributes
                  </td>
                  <td
                    class="w-64 border border-gray-300 px-4 py-2 capitalize text-sm"
                  >
                    Attributes Value
                  </td>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(effect, index) in JSON.parse(selectedSet.effects)"
                  :key="index"
                >
                  <td
                    class="text-center w-64 border border-gray-300 px-4 py-2 text-sm capitalize"
                  >
                    {{ index.split("_")[index.split("_").length - 1] }}/{{
                      selectedSet.items.length
                    }}
                  </td>
                  <td
                    class="w-64 border border-gray-300 px-4 py-2 text-sm capitalize text-center"
                  >
                    {{
                      index
                        .replace(/_/gi, " ")
                        .replace(/^DST/, "")
                        .replace(/\d+/gi, "")
                    }}
                  </td>
                  <td
                    class="w-64 text-center border border-gray-300 px-4 py-2 text-sm capitalize"
                  >
                    {{ effect }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!--footer-->
          <div
            class="flex items-center justify-end p-6 border-t border-solid border-gray-300 rounded-b"
          >
            <button
              class="border border-solid border-red-500 bg-red-500 text-white font-medium uppercase text-sm px-6 py-2 rounded-sm outline-none focus:outline-none mr-1 mb-1"
              type="button"
              style="transition: all 0.15s ease"
              v-on:click="closeShowEffect"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <div
      v-if="showModalSetEffect"
      class="opacity-25 fixed inset-0 z-40 bg-black"
    ></div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      sets: [],
      setsBeforeSearch: [],
      search: "",
      selectedSet: {},
      showModalSetEffect: false,
    };
  },
  methods: {
    get() {
      axios.get("records/set").then((response) => {
        this.sets = response.data;
      });
    },
    searchSet() {
      this.setsBeforeSearch = this.sets;
      axios.get(`/admin/set/search/${this.search}`).then((response) => {
        this.sets = response.data;
      });
    },
    viewSetEffects(set) {
      this.selectedSet = set;
      this.showModalSetEffect = !this.showModalSetEffect;
    },
    formatDate(date) {
      return moment(date).format("MMMM Do YYYY, h:mm A");
    },
    closeShowEffect() {
      this.showModalSetEffect = !this.showModalSetEffect;
      this.selectedSet = {};
    },
  },
  created() {
    this.get();
  },
  watch: {
    search(to) {
      if (!to) {
        this.sets = this.setsBeforeSearch;
      }
    },
  },
};
</script>
