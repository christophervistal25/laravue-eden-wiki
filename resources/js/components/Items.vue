<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 p-2">
    <button
      @click="back"
      class="bg-green-300 rounded-full shadow-lg transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-110 focus:outline-none"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="icon icon-tabler icon-tabler-arrow-narrow-left"
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
        <line x1="5" y1="12" x2="19" y2="12" />
        <line x1="5" y1="12" x2="9" y2="16" />
        <line x1="5" y1="12" x2="9" y2="8" />
      </svg>
    </button>

    <h1
      class="text-gray-700 text-3xl uppercase font-bold tracking-widest border-b-2 border-green-200 border-dashed mt-5"
    >
      # {{ sub_category.name }}
    </h1>

    <div class="grid grid-cols-4 gap-4 mt-2">
      <div v-for="item in sub_category.items" :key="item.id">
        <div
          v-if="item.set"
          class="bg-green-300 px-2 py-1 absolute w-auto font-medium animate-bounce"
        >
          SET PART
        </div>
        <!-- <div v-else class="bg-green-300 px-2 py-2">&nbsp;</div> -->
        <div
          @click="view(item)"
          class="card flex flex-col p-10 bg-white rounded-lg shadow-2xl hover:bg-green-100 transition duration-300 ease-in-out cursor-pointer"
        >
          <div class="prod-title flex">
            <div v-if="!imagesListLoad.includes(item.name)">
              <svg
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
              <!-- <div
                class="w-8 h-8 bg-green-300 animate-pulse rounded-full"
              ></div> -->
            </div>
            <img
              :src="/images/ + item.icon"
              class="object-cover object-center"
              @load="onImageLoad(item.name)"
            />
            <p class="ml-5 mt-auto text-lg uppercase text-gray-900 font-bold">
              {{ item.name ? item.name.substr(0, 13) : "..." }}
            </p>
          </div>
        </div>
      </div>
    </div>
    <div v-if="MAX_DISPLAY <= sub_category.items.length">
      <button
        @click="loadMoreData"
        class="bg-green-300 p-3 font-bold uppercase tracking-wider rounded mt-5 shadow-sm transition duration-500 ease-in-out hover:shadow-lg focus:outline-none text-sm w-auto flex ml-auto mr-auto"
      >
        <svg
          v-if="isLoadMoreData"
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
        <span class="mt-auto ml-1" v-if="!isLoadMoreData">Load more</span>
      </button>
    </div>
    <item-modal
      :display="showItemModal"
      @modalClose="close"
      :item="item"
    ></item-modal>
  </div>
</template>

<script>
import ItemModal from "./ItemModal.vue";
export default {
  props: {
    sub_category: {
      required: true,
    },
  },
  data() {
    return {
      MAX_DISPLAY: 23,
      item: {},
      showItemModal: false,
      imagesListLoad: [],
      isLoadMoreData: false,
    };
  },
  components: {
    ItemModal,
  },
  methods: {
    back() {
      window.location.href = "/docs";
    },
    onImageLoad(item) {
      this.imagesListLoad.push(item);
    },
    view(item) {
      this.showItemModal = true;
      this.item = item;
    },
    close() {
      this.showItemModal = !this.showItemModal;
    },
    loadMoreData() {
      this.isLoadMoreData = true;
      window.axios
        .get(`/item/${this.sub_category.id}/show/more`)
        .then((response) => {
          this.sub_category.items = this.sub_category.items.concat(
            response.data.items
          );
          this.MAX_DISPLAY = this.sub_category.items.length + 1;
          this.isLoadMoreData = false;
        });
    },
  },
};
</script>

<style>
</style>