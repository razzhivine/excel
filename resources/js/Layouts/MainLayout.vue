<script>
import { Link } from '@inertiajs/vue3';
import Navigation from "@/Components/Navigation.vue";

export default {
  name: "MainLayout",
  components: {Navigation, Link}
}
</script>

<template>
  <Navigation></Navigation>
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 py-6">
    <slot></slot>
  </div>
</template>

<style scoped>

</style>
