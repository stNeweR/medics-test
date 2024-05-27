<template>
  <div>
    <div v-if="person">
      <form @submit.prevent="deletePerson"  action="">
        <button>Удалить пользователя</button>
      </form>
      <router-link :to="{name: 'personEdit',  params:{ id: personId }}">Изменить пользователя</router-link>
      <p><b>Имя:</b> {{ person.first_name }}</p>
      <p><b>Отчество:</b> {{ person.second_name }}</p>
      <p><b>Фамилия:</b> {{ person.last_name }}</p>
      <p class=""><b>Номера телефонов: </b>
      <ul class="">
        <li class="flex gap-2" v-for="phone in person.phones">
          {{ phone.phone_number }}
          <form @submit.prevent="deletePhone(phone.id)">
            <button>Удалить номер</button>
          </form>
          <PhoneEditPopup :id="phone.id" :phone="phone.phone_number" :personId="personId" @popupClose="getPersonData"/>
        </li>
      </ul>
      </p>
    </div>
    <h1><b>Добавить номер</b></h1>
    <form @submit.prevent="addPhone" class="flex flex-col w-3/4 gap-1">
      <label for="phone_number">Введите номер для пользователя (вот в таком формате +7 (902) 560-95-54)</label>
      <input type="tel" name="phone_number" required id="phone_number" class="border border-gray-400 rounded-md px-3 py-2" v-model="phoneNumber">
      <button>Добавить</button>
    </form>
  </div>
</template>

<script setup>
import { useRouter } from "vue-router";
import { onMounted, reactive, ref } from "vue";
import axios from "axios";
import PhoneEditPopup from "@/components/PhoneEditPopup.vue";

const router = useRouter()

const props = defineProps({
  id: Number
})

const personId = props.id
const person = ref([])
const phoneNumber = ref('');


const getPersonData = async () => {
  try {
    const response = await axios.get(`http://localhost:8080/api/peoples/show?id=${personId}`)
    person.value = response.data['peoples'][0]
  } catch (error) {
    console.error(error)
  }
}

onMounted(getPersonData)

const addPhone = async  () => {
  try {
    await fetch(`http://localhost:8080/api/peoples/phones?id=${personId}/`, {
      method: 'POST',
      mode: 'no-cors',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        phone_number: phoneNumber.value
      })
    })

    getPersonData();
    phoneNumber.value = ''
  } catch (error) {
    console.error(error)
  }
}

const deletePhone = async (id) => {
  try {
    await fetch(`http://localhost:8080/api/peoples/phones/delete?id=${id}`, {
      method: 'POST',
      mode: 'no-cors',
      headers: {
        'Content-Type': 'application/json',
      },
    });

    getPersonData();
  } catch (error) {
    console.error(error)
  }
}

const deletePerson = async () => {
  try {
    await fetch(`http://localhost:8080/api/peoples/delete?id=${personId}`, {
      method: 'POST',
      mode: 'no-cors',
      headers: {
        'Content-Type': 'application/json',
      },
    });

    await router.push('/')
  } catch (error) {
    console.error(error)
  }
}
</script>