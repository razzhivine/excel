<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Head} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Button from "@/Components/Button.vue";
import TextInput from "@/Components/TextInput.vue";
import {toFormData} from "axios";
import NavLink from "@/Components/NavLink.vue";
import ButtonLink from "@/Components/ButtonLink.vue";

export default {
  name: "Import",
  components: {ButtonLink, NavLink, TextInput, Button, PrimaryButton, Head},
  layout: MainLayout,
  props: [
    'data'
  ],
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
      this.$inertia.post('/import_places/', formData, {
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
  <Head title="Импорт мест и достопремечательностей"/>
  <div class="text-2xl mb-3">Импорт мест и достопремечательностей</div>
  <div class="flex gap-2 mb-2">
    <input @change="setFile" type="file" name="file" id="file" ref="file" class="hidden">
    <Button @click="selectFile">Загрузить файл</Button>
    <PrimaryButton v-if="file" @click="importFile">Импорт</PrimaryButton>
  </div>
  <ButtonLink :href="data.link" target="_blank">Пример файла</ButtonLink>
</template>

<style scoped>

</style>
