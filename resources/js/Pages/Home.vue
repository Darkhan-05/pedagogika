<script setup>
import Layout from '@/Shared/Layout.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const username = ref(''); // Поле для хранения имени пользователя

// Функция отправки формы
function startQuiz() {
  if (username.value.trim()) {
    router.post('/create-user', { name: username.value }, {
      onSuccess: () => {
        router.get('/quiz'); // После создания пользователя перенаправляем на тест
      }
    });
  } else {
    alert('Есіміңізді енгізіңіз');
  }
}
</script>

<template>
  <Layout>
    <div class="px-4 py-5 my-5 text-center">
      <h1 class="display-5 fw-bold text-body-emphasis">Тест</h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Тестті бастау үшін атыңызды енгізіңіз</p>
        <div class="input-group mb-3">
          <input type="text" v-model="username" class="form-control" placeholder="Есіміңіз" aria-label="Есім" />
          <button @click="startQuiz" class="btn btn-primary btn-lg">Тестті бастау</button>
        </div>
      </div>
    </div>
  </Layout>
</template>

<style scoped>
.input-group {
  max-width: 400px;
  margin: 0 auto;
}
</style>
