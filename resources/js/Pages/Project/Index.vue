<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Head} from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";


export default {
    name: "Index",
    components: {
        Pagination,
        Head,
    },
    layout: MainLayout,
    props: [
        'projects'
    ]
}
</script>

<template>
    <Head title="projects index"/>
    <div class="text-lg">projects</div>
    <div v-if="projects" class="mt-4 -mb-3">
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
                                                                title
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                                                created_at_time
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                                                contracted_at
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                                                is_chain
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                worker_count
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                has_outsource
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                has_investors
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                deadline
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                is_on_time
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                service_count
                            </th>
<!--                            <th class="font-medium p-4 text-slate-400">-->
<!--                                comment-->
<!--                            </th>-->
                            <th class="font-medium p-4 text-slate-400">
                                effective_value
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                payment_first_step
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                payment_second_step
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                payment_third_step
                            </th>
                            <th class="font-medium p-4 text-slate-400">
                                payment_fourth_step
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white ">
                        <tr class="border-slate-100 border-t" v-for="project in projects.data">
                            <td class="p-4 text-slate-500">
                                {{project.id}}
                            </td>

                            <td class="p-4 text-slate-500">
                                {{project.title}}
                            </td>
                            <td class="p-4 text-slate-500 whitespace-nowrap">
                                {{project.created_at_time}}
                            </td>
                            <td class="p-4 text-slate-500 whitespace-nowrap">
                                {{project.contracted_at}}
                            </td>
                            <td class="p-4 text-slate-500">
                                {{project.is_chain}}
                            </td>
                            <td class="p-4 text-slate-500">
                                {{project.worker_count}}
                            </td>
                            <td class="p-4 text-slate-500">
                                {{project.has_outsource}}
                            </td>
                            <td class="p-4 text-slate-500">
                                {{project.has_investors}}
                            </td>
                            <td class="p-4 text-slate-500  whitespace-nowrap">
                                {{project.deadline}}
                            </td>
                            <td class="p-4 text-slate-500">
                                {{project.is_on_time}}
                            </td>
                            <td class="p-4 text-slate-500">
                                {{project.service_count}}
                            </td>
<!--                            <td class="p-4 text-slate-500">-->
<!--                                {{project.comment}}-->
<!--                            </td>-->
                            <td class="p-4 text-slate-500">
                                {{project.effective_value}}
                            </td>
                            <td class="p-4 text-slate-500">
                                {{project.payment_first_step}}
                            </td>
                            <td class="p-4 text-slate-500">
                                {{project.payment_second_step}}
                            </td>
                            <td class="p-4 text-slate-500">
                                {{project.payment_third_step}}
                            </td>
                            <td class="p-4 text-slate-500">
                                {{project.payment_fourth_step}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <Pagination :meta="projects.meta"></Pagination>
    </div>

</template>

<style scoped>

</style>
