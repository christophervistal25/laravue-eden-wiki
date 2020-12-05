<template>
  <div class="flex">
    <div
      class="mr-6 py-2 w-full flex-shrink-0 flex flex-col bg-white dark:bg-gray-600 rounded-sm shadow-lg"
    >
      <h3 class="flex flex-col px-5 text-2xl font-semibold dark:text-gray-300">
        <span>Edit Category</span>
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
              name
            </label>
            <input
              class="appearance-none block w-full text-gray-700 border rounded-sm py-2 px-4 focus:outline-none bg-white border-gray-500 mb-3 capitalize"
              type="text"
              v-model="category.name"
            />
          </div>
          <div class="w-full px-3">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >
              Description
            </label>
            <textarea
              class="w-full appearance-none text-gray-700 border rounded-sm py-2 px-4 focus:outline-none bg-white border-gray-500"
              cols="30"
              rows="10"
              v-model="category.description"
            ></textarea>
          </div>

          <div class="w-full px-3">
            <div
              class="relative ml-1 inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in"
            >
              <input
                type="checkbox"
                id="status"
                @click="changeStatus"
                :checked="category.status === 'active' ? true : false"
                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer focus:outline-none"
              />
              <label
                for="status"
                class="list-none toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
              ></label>
            </div>
            <label
              for="status"
              class="text-xs text-gray-700 font-bold cursor-pointer capitalize"
              >{{
                category.status === "active" ? "Active" : "In-Active"
              }}</label
            >
          </div>

          <div class="float-right mr-2">
            <button
              @click="updateCategory"
              class="bg-green-500 hover:bg-green-400 focus:border-green-500 focus:outline-none text-white py-2 px-4 rounded-sm uppercase text-sm"
              type="button"
            >
              <svg
                v-if="isLoad"
                xmlns="http://www.w3.org/2000/svg"
                class="animate-spin h-6 w-6"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="#FFFFFF"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5" />
              </svg>
              <span v-if="!isLoad"> Update Category </span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
  
  <script>
export default {
  props: {
    category: {
      required: true,
      type: Object,
    },
  },
  data() {
    return {
      formError: {},
      hasError: false,
      isLoad: false,
    };
  },
  methods: {
    changeStatus() {
      if (this.category.status.toLowerCase() === "active") {
        this.category.status = "in-active";
      } else {
        this.category.status = "active";
      }
    },
    updateCategory() {
      this.hasError = false;
      this.formError = {};
      this.isLoad = true;

      axios
        .put(`/category/${this.category.id}/edit`, this.category)
        .then((response) => {
          this.isLoad = false;
          if (response.status === 202) {
            swal("Good Job!", response.data.message, "success");
          }
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.isLoad = false;
            this.formError = error.response.data;
            this.hasError = true;
          }
        });
    },
  },
};
</script>
<style scoped>
.toggle-checkbox:checked {
  right: 0;
  border-color: #68d391;
}
.toggle-checkbox:checked + .toggle-label {
  background-color: #68d391;
}
</style>