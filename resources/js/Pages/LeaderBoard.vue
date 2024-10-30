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
    <div class="container py-5">
      <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary">Таблица Лидеров</h1>
        <p class="lead text-muted">Поздравляем лучших участников с наивысшими результатами!</p>
      </div>

      <div class="row justify-content-center">
        <!-- Таблица лидеров -->
        <div class="col-md-8">
          <div class="table-responsive shadow-lg p-3 mb-5 bg-white rounded">
            <table class="table table-hover text-center">
              <thead class="table-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Имя</th>
                  <th scope="col">Процент</th>
                </tr>
              </thead>
              <tbody>
                <!-- Перебираем массив лидеров и отображаем данные по каждому -->
                <tr v-for="(leader, index) in leaderboard" :key="index">
                  <th scope="row">{{ index + 1 }}</th>
                  <td class="fw-semibold">{{ leader.name }}</td>
                  <td class="text-success fw-bold">{{ leader.score }}%</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<style scoped>
.table-responsive {
  background-color: #f8f9fa;
  border-radius: 8px;
}
.table-hover tbody tr:hover {
  background-color: #f1f3f5;
}
.table-dark {
  background-color: #343a40;
  color: #fff;
}
.text-primary {
  color: #007bff !important;
}
</style>
