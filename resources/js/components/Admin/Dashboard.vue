<template>
  <div class="dashboard">
    <div class="my-4">
      <widgets></widgets>
    </div>

    <div class="flex">
      <div
        class="mr-6 py-2 w-full flex-shrink-0 flex flex-col bg-white shadow-sm"
      >
        <h3
          class="flex flex-col px-5 font-semibold dark:text-gray-300 text-2xl"
        >
          <span>Categories</span>
        </h3>
        <div class="flex flex-col p-8 py-3">
          <!-- :changed="updatedRecordInSubCategory"
                @category-count="noOfCategory"
                -->
          <category></category>
        </div>
      </div>
    </div>

    <div class="flex mt-5">
      <div
        class="mr-6 py-2 w-full flex-shrink-0 flex flex-col bg-white shadow-sm"
      >
        <h3
          class="flex flex-col px-5 font-semibold dark:text-gray-300 text-2xl"
        >
          <span>Sub-categories</span>
        </h3>
        <div class="flex flex-col p-8 py-3">
          <!-- :changed="updatedRecordInSubCategory"
                @category-count="noOfCategory"
                -->
          <sub-category></sub-category>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Sidebar from "./Sidebar.vue";
import Category from "./Category.vue";
import SubCategory from "./SubCategory.vue";
import Widgets from "./Widgets.vue";
// import SubCategory from "../components/Dashboard/SubCategory.vue";
// import Widgets from "../components/Dashboard/Widgets.vue";
export default {
  props: {
    user: {
      required: true,
      type: Object,
    },
  },
  data() {
    return {
      updatedRecordInSubCategory: 0,
      categoryCount: 0,
      subCategoryCount: 0,
    };
  },
  components: {
    Sidebar,
    Category,
    SubCategory,
    Widgets,
  },
  computed: {},
  methods: {
    updateCategory() {
      this.updatedRecordInSubCategory++;
    },
    noOfCategory(no_of_category) {
      this.categoryCount = no_of_category;
    },
    noOfSubCategory(no_of_sub_category) {
      this.subCategoryCount = no_of_sub_category;
    },
  },
};
</script>

