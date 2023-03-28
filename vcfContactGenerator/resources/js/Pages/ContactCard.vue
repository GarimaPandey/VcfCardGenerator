
@extends('app')

<template>
  <div>
    <ul>
        {{user}}
        
    </ul>
  </div>
</template>

<script>
   export default {
        props: {
            user: Array
        }
    }
</script>
