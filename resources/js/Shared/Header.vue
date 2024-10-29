<script setup>
import {Link,usePage} from '@inertiajs/vue3'
import {computed} from 'vue'
const page=usePage()
const appName=computed(()=>page.props.appName)
</script>
<template>
  <header class="d-flex justify-content-center py-3">
     <div class="col-md-3 mb-2 mb-md-0">
       <Link href="/" class="d-inline-flex link-body-emphasis ">
       <span class="fs-4">{{ appName }}</span>
     </Link>
     </div>
      <ul class="nav nav-pills">
        <li class="nav-item"><Link href="/" :class="{'nav-link active':$page.url==='/','nav-link':$page.url != '/'}"  aria-current="page">Басты бет</Link></li>
        <li class="nav-item"><Link href="/quiz" :class="{'nav-link active':$page.url==='/quiz','nav-link':$page.url != '/quiz'}">Тест</Link></li>
        <li class="nav-item"><Link href="/leaderboard" :class="{'nav-link active':$page.url==='/leaderboard','nav-link':$page.url != '/leaderboard'}">Лидеры</Link></li>
      </ul>
    </header>
</template>
