<template>
  <div>
    <div
      v-if="display"
      class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex"
    >
      <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div
          class="border-0 rounded-sm shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none"
        >
          <!--header-->
          <div
            class="flex items-start p-5 border-b border-dashed border-green-300 rounded-t"
          >
            <img
              :src="`/images/${item.icon}`"
              class="object-cover object-center mr-5"
              alt=""
            />
            <h3 class="text-3xl font-semibold uppercase">{{ item.name }}</h3>
          </div>
          <!--body-->
          <div class="relative p-6 flex-auto">
            <p
              v-show="item.description"
              class="text-gray-700 text-md leading-relaxed mb-5 text-justify"
            >
              {{ item.description }}
            </p>
            <table class="table-auto">
              <thead>
                <tr>
                  <td
                    class="border border-gray-300 w-64 p-2 font-medium text-center"
                  >
                    Min. Level
                  </td>
                  <td
                    class="border border-gray-300 w-64 p-2 font-medium text-center"
                  >
                    Applicable Job
                  </td>
                  <td
                    class="border border-gray-300 w-64 p-2 font-medium text-center"
                  >
                    Effects
                  </td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="border border-gray-300 w-64 text-center p-2">
                    {{ item.level }}
                  </td>
                  <td class="border border-gray-300 w-64 text-center p-2">
                    {{ item.job }}
                  </td>
                  <td
                    class="border border-gray-300 w-64 p-2 text-center text-sm"
                  >
                    {{ item.effect_1 }}, {{ item.effect_2 }},
                    {{ item.effect_3 }}
                  </td>
                </tr>
              </tbody>
            </table>
            <div v-if="item.set">
              <hr class="my-4 border border-dashed border-gray-600" />
              <p class="text-gray-800 leading-relaxed font-semibold">Parts :</p>
              <div class="flex flex-row justify-center">
                <div
                  v-for="part in item.set.items"
                  :key="part.id"
                  class="rounded-full mr-3"
                >
                  <span
                    class="uppercase px-2 py-2 bg-green-300 font-medium tracking-wider"
                  >
                    {{ part.name }}
                  </span>
                  <img
                    :src="`/images/${part.icon}`"
                    class="ml-auto mr-auto animate-pulse"
                    alt=""
                  />
                </div>
              </div>
              <p class="text-gray-800 leading-relaxed font-semibold">
                Set Effect :
              </p>
              <table class="table-auto">
                <thead>
                  <tr class="text-center">
                    <td class="border border-gray-300 w-64 p-2 font-medium">
                      # of Parts
                    </td>
                    <td class="border border-gray-300 w-64 p-2 font-medium">
                      Attribute
                    </td>
                    <td class="border border-gray-300 w-64 p-2 font-medium">
                      Attribute Value
                    </td>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(effect, index) in JSON.parse(item.set.effects)"
                    :key="index"
                  >
                    <td
                      class="text-center w-64 border border-gray-300 px-4 py-2 text-sm capitalize"
                    >
                      {{ index.split("_")[index.split("_").length - 1] }} /
                      {{ item.set.items.length }}
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

            <!-- <p class="my-1 text-gray-600 text-lg leading-relaxed">
              {{ item }}
            </p>
            <p class="my-1 text-gray-600 text-lg leading-relaxed">
              {{ item.name }}
            </p>
            <p class="my-1 text-gray-600 text-lg leading-relaxed">
              {{ item.description }}
            </p> -->
          </div>
          <!--footer-->
          <div
            class="flex items-center justify-end p-6 border-t border-dashed border-green-300 rounded-b"
          >
            <button
              class="bg-green-300 text-gray-800 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1"
              type="button"
              style="transition: all 0.15s ease"
              v-on:click="close"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="display" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
  </div>
</template>

<script>
export default {
  props: {
    display: {
      required: true,
    },
    item: {
      required: true,
      type: Object,
    },
  },
  methods: {
    close() {
      this.$emit("modalClose");
    },
  },
};
</script>