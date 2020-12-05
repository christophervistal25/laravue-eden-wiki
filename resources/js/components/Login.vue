<template>
  <section class="absolute w-full top-0">
    <!-- style="
        background-image: url('https://res.cloudinary.com/dhoso0sdj/image/upload/v1598286323/soulstice-flyff/parser-bg_nwsfxf.png');
        background-size: 100%;
        background-repeat: no-repeat;
      " -->
    <div class="absolute top-0 w-screen h-screen bg-gray-100"></div>

    <div class="container mx-auto px-4 h-full">
      <div class="flex content-center items-center justify-center h-full">
        <div class="w-full lg:w-4/12 px-4 pt-32">
          <div
            v-if="displayErrorMessage"
            class="bg-red-100 border text-red-700 px-4 py-3 relative mb-3"
            role="alert"
          >
            <strong class="font-medium">Opps! </strong>
            <span class="block sm:inline">Invalid Username / Password.</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
              <svg
                @click="displayErrorMessage = false"
                class="fill-current h-6 w-6 text-red-500"
                role="button"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
              >
                <title>Close</title>
                <path
                  d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"
                />
              </svg>
            </span>
          </div>
          <div
            class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-sm bg-white border-0"
          >
            <div class="mb-0 px-6 py-6">
              <div class="text-center">
                <span class="text-gray-800 text-sm font-medium capitalize">
                  welcome back!
                </span>
                <!-- <img
                  class="object-cover w-32 ml-auto mr-auto"
                  src="../assets/witch-hat.png"
                  alt=""
                /> -->
              </div>
              <hr class="mt-2 border-b-1 border-gray-400" />
            </div>

            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
              <form @submit.prevent="login">
                <div class="relative w-full mb-3">
                  <label
                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                    for="grid-password"
                    >Email</label
                  >
                  <input
                    type="text"
                    class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                    placeholder="Username"
                    v-model="email"
                    required
                    style="transition: all 0.15s ease 0s"
                  />
                </div>
                <div class="relative w-full mb-3">
                  <label
                    class="block uppercase text-gray-700 text-xs font-bold mb-2"
                    for="grid-password"
                    >Password</label
                  >
                  <input
                    type="password"
                    v-model="password"
                    required
                    class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full"
                    placeholder="Password"
                    style="transition: all 0.15s ease 0s"
                  />
                </div>
                <div class="text-center mt-6">
                  <button
                    class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full"
                    type="submit"
                    style="transition: all 0.15s ease 0s"
                  >
                    <svg
                      v-show="isLoading"
                      class="h-6 w-6 ml-auto mr-auto text-green-500"
                      viewBox="0 0 38 38"
                      stroke="currentColor"
                    >
                      <g fill="none" fill-rule="evenodd">
                        <g transform="translate(1 1)" stroke-width="2">
                          <circle
                            stroke-opacity=".3"
                            cx="18"
                            cy="18"
                            r="18"
                          ></circle>
                          <path d="M36 18c0-9.94-8.06-18-18-18">
                            <animateTransform
                              attributeName="transform"
                              type="rotate"
                              from="0 18 18"
                              to="360 18 18"
                              dur="1s"
                              repeatCount="indefinite"
                            ></animateTransform>
                          </path>
                        </g>
                      </g>
                    </svg>
                    <span v-show="!isLoading">Sign In</span>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  data() {
    return {
      email: "chris@yahoo.com",
      password: "1234",
      displayErrorMessage: false,
      isLoading: false,
    };
  },
  components: {},
  methods: {
    login() {
      this.isLoading = true;
      if (!this.email || !this.password) {
        this.displayErrorMessage = true;
        this.isLoading = false;
      }

      axios
        .post(`login`, {
          email: this.email,
          password: this.password,
        })
        .then((response) => {
          if (response.status == 204) {
            this.isLoading = false;
            window.location.href = "/admin/dashboard";
          }
        })
        .catch(() => {
          this.displayErrorMessage = true;
          this.isLoading = false;
        });
    },
  },
};
</script>