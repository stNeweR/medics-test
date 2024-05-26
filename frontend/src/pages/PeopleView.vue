<template>
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
            <li v-for="phone in contact.phones " :key="phone"> {{ phone }} </li>
            <li v-if="contact.phones.length === 0">
              <button>Добавить номер</button>
            </li>
          </ul>
        </td>
        <td>{{ contact.created_at }}</td>
        <td>
          <router-link :to="`/peoples/${contact.id}`">Подробнее</router-link>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";

const contacts = ref([])

onMounted( async () => {
  try {
    const response = await axios.get('http://localhost:8080/api/peoples');
    contacts.value = response.data.peoples
  } catch (error) {
    console.error(error)
  }
})
</script>