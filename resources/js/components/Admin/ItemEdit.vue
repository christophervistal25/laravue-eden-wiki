<template>
  <div class="flex">
    <div
      class="mr-6 py-2 w-full flex-shrink-0 flex flex-col bg-white shadow-sm"
    >
      <h3 class="flex flex-col px-5 font-semibold dark:text-gray-300 text-2xl">
        <span>Edit Item</span>
      </h3>
      <div class="flex flex-col p-8 py-3">
        <div class="relative px-6 py-2 flex-auto">
          <div v-if="errors">
            <p
              class="text-red-400 text-sm"
              v-for="(error, index) in errors"
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
            class="flex flex-col flex-grow appearance-none w-full text-gray-700 border py-2 px-4 mb-3 outline-none bg-white border-gray-500 rounded-sm capitalize"
            type="text"
            v-model="item.name"
            placeholder="Enter item name"
          />

          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            Description <span class="text-red-500 align-middle">*</span>
          </label>
          <textarea
            class="flex flex-col flex-grow appearance-none w-full text-gray-700 border py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500 rounded-sm"
            rows="4"
            v-model="item.description"
            placeholder="Enter item description"
          ></textarea>

          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            Category / Sub-category
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
          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            icon
            <span class="text-blue-600 font-normal">
              - Attach icon to replace otherwise leave blank</span
            >
          </label>
          <hr class="mb-1" />
          <img
            :src="/images/ + item.icon"
            class="bg-white p-1 object-contain w-auto"
            alt=""
          />
          <label
            for="uploadFile"
            class="inline-flex mt-3 appearance-none w-auto text-gray-700 bg-white rounded-sm border py-2 px-4 focus:outline-none cursor-pointer shadow"
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
            {{ icon ? icon.name : "Replace icon" }}
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
            gender
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
            level
          </label>
          <input
            class="text-sm flex flex-col flex-grow appearance-none w-full text-gray-700 border py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500 rounded-sm"
            type="number"
            v-model="item.level"
            placeholder="Level"
          />

          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            job / class
          </label>
          <input
            class="text-sm flex flex-col flex-grow appearance-none w-full text-gray-700 border py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500 rounded-sm"
            type="text"
            v-model="item.job"
            placeholder="Enter Job / Class"
          />

          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            item effect 1
          </label>
          <input
            class="text-sm flex flex-col flex-grow appearance-none w-full text-gray-700 border py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500 rounded-sm uppercase"
            type="text"
            v-model="item.effect_1"
            placeholder="INT : 50"
          />

          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            item effect 2
          </label>
          <input
            class="text-sm flex flex-col flex-grow appearance-none w-full text-gray-700 border py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500 rounded-sm uppercase"
            type="text"
            v-model="item.effect_2"
            placeholder="STR : 50"
          />

          <label
            class="block uppercase tracking-wide text-gray-700 text-xs font-bold"
          >
            item effect 3
          </label>
          <input
            class="text-sm flex flex-col flex-grow appearance-none w-full text-gray-700 border py-2 px-4 mb-3 focus:outline-none bg-white border-gray-500 rounded-sm uppercase"
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

          <div
            class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in"
          >
            <input
              @click="changeState"
              type="checkbox"
              name="toggle"
              id="toggle"
              :checked="item.status.toLowerCase() === 'active' ? true : false"
              class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer focus:outline-none"
            />
            <label
              for="toggle"
              class="list-none toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"
            ></label>
          </div>
          <label
            for="toggle"
            class="text-xs text-gray-700 font-bold cursor-pointer capitalize"
            >{{ status }}</label
          >

          <button
            class="float-right text-white bg-transparent border border-solid border-green-500 bg-green-500 uppercase text-sm px-6 py-2 rounded-sm outline-none focus:outline-none mr-1 mb-1"
            type="button"
            style="transition: all 0.15s ease"
            v-on:click="submitUpdateItem"
          >
            Update Item
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
    item: {
      required: true,
      type: Object,
    },
  },
  data() {
    return {
      errors: [],
      icon: "",
      status: "active",
    };
  },
  methods: {
    changeState() {
      if (this.status.toLowerCase() === "active") {
        this.status = "in-active";
      } else {
        this.status = "active";
      }
    },
    onImageAttach(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) {
        console.log("no files");
      }
      this.icon = files[0];
    },

    submitUpdateItem() {
      let formData = new FormData();

      for (const [key, value] of Object.entries(this.item)) {
        formData.append(key, value);
      }
      formData.append("icon", this.icon);
      formData.append("status", this.status);
      axios
        .post(`/admin/item/${this.item.id}/edit`, formData)
        .then((response) => {
          if (response.status === 202) {
            this.formErrors = [];
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
  created() {
    this.status = this.item.status;
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
