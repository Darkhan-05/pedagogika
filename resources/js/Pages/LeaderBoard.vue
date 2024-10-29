<script setup>
import Layout from '@/Shared/Layout.vue';
import { defineProps } from 'vue';

// Определяем получаемые свойства
defineProps({
    leaderboard: Array
});
</script>

<template>
  <Layout>
    <div class="px-4 py-5 my-5 text-center">
      <h1 class="display-5 fw-bold text-body-emphasis">Лидеры</h1>
      <div class="col-lg-8 mx-auto">
        <table class="table table-striped mt-4">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Имя</th>
              <th scope="col">Процент</th>
              <th scope="col">Комментарий</th>
            </tr>
          </thead>
          <tbody>
            <!-- Перебираем массив лидеров и отображаем данные по каждому -->
            <tr v-for="(leader, index) in leaderboard" :key="index">
              <th scope="row">{{ index + 1 }}</th>
              <td>{{ leader.username }}</td>
              <td>{{ leader.percentage }}%</td>
              <td>{{ leader.comment }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </Layout>
</template>
