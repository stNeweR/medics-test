<template>
  <h1>Организации</h1>
</template>

<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";

const contacts = ref([])

const fetchContacts = async () => {
  try {
    const response = await axios.get('http://localhost:8080/api/peoples');
    contacts.value = response.data
    console.log(contacts)
  } catch (error) {
    console.error(error)
  }
}

onMounted(fetchContacts)
</script>
