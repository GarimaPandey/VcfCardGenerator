
@extends('app')

<template>
  <div>
    <ul>
        <ll v-for="user in user_data" :key="user.first_name">
        {{user.first_name}}
        </li>
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
