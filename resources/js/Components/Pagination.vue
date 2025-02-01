<script>
import {Link} from '@inertiajs/vue3';

export default {
    name: "Pagination",
    components: {
        Link
    },
    props: [
        'meta'
    ],
}
</script>

<template>
    <nav v-if="meta.links.length > 0" class="mt-3 mx-auto w-fit flex overflow-hidden  gap-1">
        <template v-for="link in meta.links">
            <Link
                v-if="link.url"
                :href="link.url"
                :class="
                    [
                        'relative inline-flex items-center px-4 py-2 text-sm border rounded',
                        link.active
                        ? 'z-10 bg-indigo-600 border-indigo-600 text-white'
                        : 'text-gray-900  hover:bg-gray-50'
                    ]
                "
                v-html="link.label"
            >
            </Link>
        </template>

    </nav>
</template>

<style scoped>

</style>
