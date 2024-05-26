<template>
  <header class="my-4 mx-10">
    <nav>
      <ul class="flex gap-3">
        <li>
          <router-link :to="{ name: 'people' }">Таблица пользователей</router-link>
        </li>
        <li>
          <router-link :to="{ name: 'organizations' }">Таблица с организациями/департаментами</router-link>
        </li>
      </ul>
    </nav>
  </header>
</template>
