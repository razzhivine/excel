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
        'failedList'
    ]
}
</script>

<template>
    <Head title="task index"/>
    <div class="text-lg">task #{{failedList.data[0].task_id}}</div>
    <div v-if="failedList" class="mt-4 -mb-3">
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
                                row
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                key
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                message
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                task id
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                date
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white ">
                        <tr class="border-slate-100 border-t" v-for="failedItem in failedList.data">
                            <td class="p-4 text-slate-500">
                                {{ failedItem.id }}
                            </td>
                            <td class="p-4 text-slate-500 ">
                                {{ failedItem.row }}
                            </td>
                            <td class="p-4 text-slate-500 ">
                                {{ failedItem.key }}
                            </td>
                            <td class="p-4 text-slate-500">
                                {{ failedItem.message }}
                            </td>
                            <td class="p-4 text-slate-500">
                                {{ failedItem.task_id }}
                            </td>

                            <td class="p-4 text-slate-500 whitespace-nowrap">
                                {{ failedItem.created_at }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <Pagination :meta="failedList.meta"></Pagination>

    </div>

</template>

<style scoped>

</style>
