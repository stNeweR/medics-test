<template>
  <form action="" @submit.prevent="updatePerson" class="flex flex-col w-1/2">
    <label for="last_name">Фамилия</label>
    <input type="text" id="last_name" name="last_name" class="border border-black" v-model="person.last_name">
    <label for="first_name">Имя</label>
    <input type="text" id="first_name" name="first_name" class="border border-black" v-model="person.first_name">
    <label for="second_name">Отчество</label>
    <input type="text" id="second_name" name="second_namee" class="border border-black" v-model="person.second_name">
    <button>Изменить</button>
  </form>
</template>

<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";
import {useRouter} from "vue-router";

const person = ref([])
const router = useRouter()
const props = defineProps({
  id: Number
})

const getPersonData = async () => {
  try {
    const response = await axios.get(`http://localhost:8080/api/peoples/show?id=${props.id}`)
    person.value = response.data['peoples'][0]
  } catch (error) {
    console.error(error)
  }
}

onMounted(getPersonData)

const updatePerson = async () => {
  try {
    const response = await fetch(`http://localhost:8080/api/peoples/update?id=${props.id}`, {
      method: 'POST',
      mode: 'no-cors',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        first_name: person.value.first_name,
        last_name: person.value.last_name,
        second_name: person.value.second_name
      })
    })

    await router.push('/')
  } catch (error) {
    console.log(error)
  }
}

</script>
