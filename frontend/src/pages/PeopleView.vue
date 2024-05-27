<template>
  <h1>Добавить пользователя</h1>
  <form @submit.prevent="addPerson" class="flex flex-col w-1/3">
    <label for="last_name">Фамилия:</label>
    <input type="text" id="last_name" name="last_name" class="border border-black" v-model="last_name">
    <label for="first_name">Имя:</label>
    <input type="text" id="first_name" name="first_name" class="border border-black" v-model="first_name">
    <label for="second_name">Отчество:</label>
    <input type="text" id="second_name" name="second_name" class="border border-black"  v-model="second_name">
    <button>Добавить</button>
  </form>
  <h1>Контакты пользователей</h1>
  <table class="min-w-full text-left">
    <thead>
      <tr>
        <th>ID</th>
        <th>Полное имя</th>
        <th>Номера</th>
        <th>Когда добавлен</th>
        <th>Подробнее</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="contact in contacts" :key="contact.id">
        <td>{{ contact.id }}</td>
        <td>{{ contact.first_name }} {{ contact.second_name }} {{ contact.last_name }}</td>
        <td>
          <ul class="flex gap-2">
            <li v-for="phone in contact.phones " :key="phone"> {{ phone.phone_number }} </li>
            <li v-if="contact.phones.length === 0">
              <router-link :to="{ name: 'person', params: {id: contact.id}}">Добавить номер</router-link>
            </li>
          </ul>
        </td>
        <td>{{ contact.created_at }}</td>
        <td>
          <router-link :to="{ name: 'person', params: {id: contact.id}}">Подробнее</router-link>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script setup>
import {onMounted, reactive, ref} from "vue";
import axios from "axios";

const contacts = ref([])
const first_name = ref('')
const second_name = ref('')
const last_name = ref('')

const getPeopleData = async () => {
  try {
    const response = await axios.get('http://localhost:8080/api/peoples');
    contacts.value = response.data.peoples
  } catch (error) {
    console.error(error)
  }
}

onMounted(getPeopleData)

const addPerson = async () => {
  const data = {
    'first_name': first_name.value,
    'second_name': second_name.value,
    'last_name': last_name.value,
  }
  try {
    const response = await fetch(`http://localhost:8080/api/peoples/store`, {
      method: 'POST',
      mode: 'no-cors',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data)
    })

    getPeopleData()
    last_name.value = ''
    first_name.value = ''
    second_name.value = ''

    console.log(response)
  } catch (error) {
    console.error(error)
  }
}
</script>