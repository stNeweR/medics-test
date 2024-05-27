<template>
  <button @click="openPopup">Редактировать</button>
  <div v-if="showPopup" class="fixed z-10 inset-0 overflow-y-auto bg-gray-500 bg-opacity-50">
    <div class="flex items-center justify-center min-h-screen">
      <div class="bg-white border border-gray-300 rounded-lg shadow-lg w-3/4 md:w-1/3 p-6">
        <h3 class="text-xl font-bold mb-4">Редактировать номер</h3>
        <form class="w-full" @submit.prevent="updatePhone">
          <input class="border border-gray-400 rounded-md px-3 py-2 w-full mb-4" v-model="newPhone" type="text"/>
          <div class="flex justify-end gap-2">
            <button type="submit" >Сохранить</button>
            <button @click="closePopup">
              Закрыть
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import {useRouter} from "vue-router";

let showPopup = ref(false)
const newPhone = ref('')
const router = useRouter()
const emit = defineEmits(['popup-close'])

const openPopup = () => {
  showPopup.value = true
}

const closePopup = () => {
  showPopup.value = false
  emit('popup-close')
}

const props = defineProps({
  id: Number,
  phone: String,
  personId: Number
})
newPhone.value = props.phone

const updatePhone = async () => {
  try {
    console.log(props.id)
    console.log(newPhone.value)
    const response = await fetch(`http://localhost:8080/api/peoples/phones/update?id=${props.id}`, {
      method: 'POST',
      mode: 'no-cors',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        phone_number: newPhone.value
      })
    })

    closePopup()
  } catch (error) {
    console.log(error)
  }
}
</script>
