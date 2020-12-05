<template>
  <div class="flex">
    <div
      class="mr-6 py-2 w-full flex-shrink-0 flex flex-col bg-white shadow-sm"
    >
      <h3 class="flex flex-col px-5 font-semibold dark:text-gray-300 text-2xl">
        <span>Create Item</span>
      </h3>
      <div class="flex flex-col p-8 py-3">
        <div>
          <div v-if="formErrors.length !== 0">
            <p
              class="text-red-400 text-sm my-2"
              v-for="(error, index) in formErrors.errors"
              v-bind:key="index"
            >
              <span>&#9862;</span> {{ error[0] }}
            </p>
            <hr class="my-2" />
          </div>

          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            Name <span class="text-red-500 align-middle">*</span>
          </label>
          <input
            class="flex flex-col flex-grow appearance-none w-full text-gray-700 border py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500 rounded-sm"
            type="text"
            v-model="item.name"
          />

          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            Description <span class="text-red-500 align-middle">*</span>
          </label>

          <textarea
            class="flex flex-col flex-grow appearance-none w-full border text-gray-700 py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500 rounded-sm"
            rows="4"
            v-model="item.description"
          ></textarea>

          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            Category / Sub - Category
            <span class="text-red-500 align-middle">*</span>
          </label>
          <select
            v-model="item.sub_category_id"
            class="appearance-none w-full text-gray-700 border py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500 capitalize rounded-sm"
          >
            <option
              v-for="sub_category in sub_categories"
              v-bind:key="sub_category.id"
              :value="`${sub_category.id}`"
            >
              {{ sub_category.category.name }} /
              {{ sub_category.name.toLowerCase() }}
            </option>
          </select>

          <hr class="mb-1" />
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            Icon
            <span class="text-red-500 align-middle">*</span>
          </label>

          <label
            for="uploadFile"
            class="inline-flex appearance-none w-auto text-gray-700 bg-white rounded-sm border py-2 px-4 focus:outline-none cursor-pointer shadow"
          >
            <svg
              v-if="!icon"
              class="w-6 h-6 mr-3"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
              ></path>
            </svg>
            {{ icon ? icon.name : "Add icon" }}

            <input
              id="uploadFile"
              class="hidden"
              type="file"
              @change="onImageAttach"
            />
          </label>

          <hr class="my-2" />

          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            Gender
          </label>
          <select
            v-model="item.gender"
            class="appearance-none w-full text-gray-700 border py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500 rounded-sm"
          >
            <option value=""></option>
            <option value="MALE">Male</option>
            <option value="FEMALE">Female</option>
          </select>

          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            Level
          </label>
          <input
            class="flex flex-col flex-grow appearance-none w-full text-gray-700 border py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500 rounded-sm"
            type="number"
            v-model="item.level"
            placeholder="1"
          />

          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            Job / class
          </label>
          <input
            class="flex flex-col flex-grow appearance-none w-full text-gray-700 border py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500 rounded-sm"
            type="text"
            v-model="item.job"
            placeholder="Ringmaster"
          />

          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            Item effect 1
          </label>
          <input
            class="flex flex-col flex-grow appearance-none w-full text-gray-700 border py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500 rounded-sm uppercase"
            type="text"
            v-model="item.effect_1"
            placeholder="INT : 50"
          />

          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            Item effect 2
          </label>
          <input
            class="flex flex-col flex-grow appearance-none w-full text-gray-700 border py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500 rounded-sm uppercase"
            type="text"
            v-model="item.effect_2"
            placeholder="STR : 50"
          />

          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            Item effect 3
          </label>
          <input
            class="flex flex-col flex-grow appearance-none w-full text-gray-700 border py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500 rounded-sm uppercase"
            type="text"
            v-model="item.effect_3"
            placeholder="DEX : 50"
          />

          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            Handed type
          </label>
          <select
            v-model="item.handed"
            class="appearance-none w-full text-gray-700 border py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500 rounded-sm"
          >
            <option value=""></option>
            <option value="HD ONE">One Handed</option>
            <option value="HD TWO">Two Handed</option>
          </select>

          <button
            class="text-white bg-transparent border border-solid border-blue-500 bg-blue-500 uppercase px-6 py-2 rounded-sm focus:outline-none mr-1 mb-1 float-right"
            type="button"
            style="transition: all 0.15s ease"
            v-on:click="submitNewItem"
          >
            Create Item
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    sub_categories: {
      required: true,
      type: Array,
      default: "",
    },
  },
  data() {
    return {
      formErrors: [],
      item: {},
      icon: "",
    };
  },
  methods: {
    onImageAttach(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) {
        console.log("no files");
      }
      this.icon = files[0];
    },

    submitNewItem() {
      let formData = new FormData();

      for (const [key, value] of Object.entries(this.item)) {
        formData.append(key, value);
      }
      formData.append("icon", this.icon);

      axios
        .post("/admin/item/create", formData)
        .then((response) => {
          if (response.status === 201) {
            this.formErrors = [];
            this.item = {};
            swal("Good job!", response.data.message, "success");
          }
        })
        .catch((err) => {
          if (err.response.status === 422) {
            this.formErrors = err.response.data;
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
