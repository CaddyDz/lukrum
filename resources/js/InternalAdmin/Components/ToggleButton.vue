<template>
    <div class="flex w-full mb-1">

      <label 
        :for="name"
        class="flex items-center cursor-pointer"
      >
        <!-- toggle -->
        <div class="relative">
          <!-- input -->
          <input :id="name" type="checkbox" class="sr-only" />
          <!-- line -->
          <div class="dot-slider w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
          <!-- dot -->
          <div class="dot absolute w-6 h-6 bg-white rounded-full shadow-md -left-1 -top-1 transition"></div>
        </div>
        <!-- label -->
        <div class="ml-3 font-medium">
          {{label}}
        </div>
      </label>

    </div>
</template>
<script>
export default {
    props: {
        label: String,
        name: String
    }
}
</script>
<style scoped>
/* Toggle A */
input:checked ~ .dot {
  transform: translateX(100%);
}

input:checked ~ .dot-slider {
  background-color: #22C55E;
}
</style>