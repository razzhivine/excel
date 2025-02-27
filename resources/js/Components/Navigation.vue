<script>
import {Link} from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";
import MobileNavLink from "@/Components/MobileNavLink.vue";

export default {
name: "Navigation" ,
  components: {MobileNavLink, NavLink, Link}
}
</script>

<template>
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex p-3 items-center justify-between hidden sm:block">

                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="hidden sm:block">
                        <div class="flex space-x-4">
<!--                            <NavLink :href="route('project.index')" :active="route().current('project.index')">index</NavLink>-->
                            <NavLink :href="route('import_places.index')" :active="route().current('import_places.index')">import places</NavLink>
<!--                            <NavLink :href="route('project.import')" :active="route().current('project.import')">import</NavLink>-->
<!--                            <NavLink :href="route('task.index')" :active="route().current('task.index')">tasks</NavLink>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <MobileNavLink :href="route('import_places.index')" :active="route().current('project.index')">import places</MobileNavLink>
<!--                <MobileNavLink :href="route('project.index')" :active="route().current('project.index')">index</MobileNavLink>-->
<!--                <MobileNavLink :href="route('project.import')" :active="route().current('project.import')">import</MobileNavLink>-->
<!--                <MobileNavLink :href="route('task.index')" :active="route().current('task.index')">tasks</MobileNavLink>-->
            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>
