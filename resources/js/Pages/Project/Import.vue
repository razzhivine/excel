<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Head} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Button from "@/Components/Button.vue";
import TextInput from "@/Components/TextInput.vue";
import {toFormData} from "axios";

export default {
    name: "Import",
    components: {TextInput, Button, PrimaryButton, Head},
    layout: MainLayout,
    data() {
        return {
            file: null,
        }
    },
    methods: {
        selectFile() {
            this.$refs.file.click()
        },
        setFile(event) {
            this.file = event.target.files[0];
        },
        importFile() {
            const formData = new FormData();
            formData.append('file', this.file)
            this.$inertia.post('/projects/import/', formData, {
                onSuccess: () => {
                    this.file = null
                    this.$refs.file.value = null
                }
            })
        }
    },

}
</script>

<template>
    <Head title="project import"/>
    <div class="flex gap-2">
        <input @change="setFile" type="file" name="file" id="file" ref="file" class="hidden">
        <Button @click="selectFile">file</Button>
        <PrimaryButton v-if="file" @click="importFile">import</PrimaryButton>
    </div>
</template>

<style scoped>

</style>
