<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Head, Link} from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";

export default {
    name: "Index",
    components: {
        Pagination,
        Head,
        Link,
    },
    layout: MainLayout,
    props: [
        'tasks'
    ]
}
</script>

<template>
    <Head title="task index"/>
    <div class="text-lg">tasks</div>

    <div v-if="tasks" class="mt-4 -mb-3">
        <div class="not-prose relative bg-slate-50 rounded-xl overflow-hidden">
            <div class="relative rounded-xl overflow-auto border">
                <div class="shadow-sm overflow-auto">
                    <table class="border-collapse table-auto w-full text-sm">
                        <thead class="text-left">
                        <tr>
                            <th class="font-medium p-4 text-slate-400">
                                id
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                user
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                file
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                status
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                failed rows
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        <tr class="border-slate-100 border-t" v-for="task in tasks.data">
                            <td class="p-4 text-slate-500">
                                {{ task.id }}
                            </td>
                            <td class="p-4 text-slate-500">
                                {{ task.user.name }}
                            </td>
                            <td class="p-4 text-slate-500">
                                {{ task.file.path }}
                            </td>
                            <td class="p-4 text-slate-500">
                                {{ task.status }}
                            </td>
                            <td class="p-4 text-slate-500">
                                <Link v-if="task.failed_rows_count > 0" :href="route('task.failed_list', task.id)">
                                    {{ task.failed_rows_count }}
                                </Link>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <Pagination :meta="tasks.meta"></Pagination>

    </div>

</template>

<style scoped>

</style>
