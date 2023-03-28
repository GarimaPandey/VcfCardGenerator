
@extends('app')

<template>
  <div>
    <p>The first name </p>
    <ul>
      <li v-for="user in user_data" :key="user.id">{{ user.first_name }}</li>

    </ul>
  </div>
</template>

<script>
   export default {
        props: {
            user_data: Array
        }
    }
</script>
