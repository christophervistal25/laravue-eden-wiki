<template>
  <div class="w-full">
    <div class="flex bg-white h-screen">
      <div
        class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2"
      >
        <div>
          <div class="flex flex-row justify-center">
            <img
              src="https://res.cloudinary.com/dfm6cr1l9/image/upload/w_300,c_scale/v1606279757/eden/eden_logo_rankuw.png"
              alt="LOGO"
            />
          </div>
          <h2
            class="text-6xl font-semibold text-gray-800 text-center subpixel-antialiased"
          >
            Learn more about
          </h2>
          <div class="w-auto text-center">
            <span
              class="text-6xl text-green-500 font-semibold cursor-pointer subpixel-antialiased"
            >
              <a href="/docs"> Eden Flyff </a>
            </span>
          </div>
          <h2
            class="mt-2 text-xl text-gray-700 text-justify subpixel-antialiased mb-3"
          >
            A <span>Mid-Rate MMORPG Private</span> Server develop by
            <span class="font-semibold">Eden Flyff</span> Development Team.
          </h2>
          <div class="flex justify-center">
            <a
              href="/docs"
              class="py-3 w-40 rounded-lg bg-gray-900 text-gray-200 font-medium hover:bg-gray-800 uppercase text-center cursor-pointer"
              style="transition: all 0.15s ease"
            >
              Get Started
            </a>
            <a
              class="py-3 w-40 rounded-lg ml-2 bg-green-600 text-white text-center font-medium hover:bg-green-500 uppercase"
              target="_blank"
              href="https://edenflyff.com/"
              style="transition: all 0.15s ease"
              >play free</a
            >
          </div>
        </div>
      </div>
      <div
        class="hidden lg:block lg:w-1/2"
        style="clip-path: polygon(10% 0, 100% 0%, 100% 100%, 0 100%)"
      >
        <div class="loopscroll">
          <div class="h-screen bg-green-200 opacity-25"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- <collage></collage> -->
</template>

<script>
// import Collage from "../components/ImageCollage";
export default {
  components: {
    // Collage,
  },
};
</script>

<style scoped>
img {
  display: block;
  padding: 0;
  margin: 0;
}
/*  ----  */
.loopscroll {
  height: auto;
  width: auto;
  background-image: url(https://res.cloudinary.com/dfm6cr1l9/image/upload/v1606284185/eden/horizontal-bg_vhf7cs.png);
  background-position: center;
  background-repeat: repeat-y;
  animation-name: backgroundloop;
  animation-iteration-count: infinite;
  animation-duration: 45s;
  animation-timing-function: linear;
}

@keyframes backgroundloop {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 0 -4831px;
  }
}
</style>