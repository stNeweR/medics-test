<template>

  <div>
    <div v-if="person">
      <p><b>Имя:</b> {{ person.first_name }}</p>
      <p><b>Отчество:</b> {{ person.second_name }}</p>
      <p><b>Фамилия:</b> {{ person.last_name }}</p>
      <p class=""><b>Номера телефонов: </b>
      <ul class="">
        <li v-for="phone in person.phones">
          {{ phone }}
        </li>
      </ul>
      </p>
    </div>
  </div>

</template>

<script setup>
import {useRoute} from "vue-router";
import {onMounted, reactive, ref} from "vue";
import axios from "axios";

const personId = reactive(useRoute().params.id)

const person = ref([])

onMounted(async () => {
  try {
    const response = await axios.get(`http://localhost:8080/api/peoples/show?id=${personId}`)
    person.value = response.data['peoples'][0]
    console.log(response.data)
  } catch (error) {
    console.error(error)
  }
})
</script>

