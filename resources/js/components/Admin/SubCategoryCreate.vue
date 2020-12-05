<template>
  <div class="flex">
    <div
      class="mr-6 py-2 w-full flex-shrink-0 flex flex-col bg-white dark:bg-gray-600 rounded-sm shadow-lg"
    >
      <h3 class="flex flex-col px-5 text-2xl font-semibold dark:text-gray-300">
        <span>Create Sub - Category</span>
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
              class="appearance-none block w-full text-gray-700 border rounded-sm py-2 px-4 focus:outline-none bg-white border-gray-500 mb-3"
              type="text"
              v-model="sub_category.name"
            />
          </div>
          <div class="w-full px-3">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-3"
            >
              Description
            </label>
            <textarea
              class="w-full appearance-none text-gray-700 border rounded-sm py-2 px-4 focus:outline-none bg-white border-gray-500"
              cols="30"
              rows="10"
              v-model="sub_category.description"
            ></textarea>
          </div>

          <div class="w-full px-3">
            <label
              class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-3"
            >
              Category
            </label>
            <select
              class="w-full appearance-none text-gray-700 border rounded-sm py-2 px-4 focus:outline-none bg-white border-gray-500 capitalize mb-2"
              v-model="sub_category.category_id"
            >
              <option
                v-for="sub_category in categories"
                :value="sub_category.id"
                :key="sub_category.id"
              >
                {{ sub_category.name }}
              </option>
            </select>
          </div>

          <div class="float-right mr-2">
            <button
              @click="createSubCategory"
              class="bg-blue-500 hover:bg-blue-400 focus:border-blue-500 focus:outline-none text-white py-2 px-4 rounded-sm uppercase text-sm"
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
              <span v-if="!isLoad"> Create Sub - Category </span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      sub_category: {},
      formError: {},
      hasError: false,
      isLoad: false,
    };
  },
  props: {
    categories: {
      required: true,
      type: Array,
    },
  },
  methods: {
    createSubCategory() {
      this.hasError = false;
      this.formError = {};
      this.isLoad = true;

      axios
        .post("/sub/category/create", this.sub_category)
        .then((response) => {
          this.isLoad = false;
          if (response.status === 201) {
            swal("Good Job!", response.data.message, "success");
            this.sub_category = {};
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
